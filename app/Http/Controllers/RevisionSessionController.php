<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Models\RevisionSession;
use App\Notifications\BaseNotification;
use App\Models\User;
use Carbon\Carbon;

class RevisionSessionController extends Controller
{
    use AuthorizesRequests; // Add this line

    /**
     * Display calendar with sessions for the authenticated user.
     */
    public function index(Request $request)
    {
        $user = auth()->user();

        $year = $request->get('year', now()->year);
        $month = $request->get('month', now()->month);

        $date = Carbon::create($year, $month, 1);

        $sessions = \App\Models\RevisionSession::whereYear('date', $year)
            ->whereMonth('date', $month)
            ->where(function ($q) use ($user) {
                $q->where('user_id', $user->id)->orWhere('partner_id', $user->id);
            })
            ->get()
            ->groupBy(function ($session) {
                return (int) Carbon::parse($session->date)->format('d');
            });

        return view('user.dashboard', [
            'sessions' => $sessions,
            'year' => $year,
            'month' => $date->format('F'),
            'monthNumber' => $date->month,
            'daysInMonth' => $date->daysInMonth,
            'firstDay' => $date->startOfMonth()->dayOfWeek, // Sunday = 0, Monday = 1, etc.
        ]);
    }

    /**
     * for revision  session creation
     */
    public function create()
    {
        $user = auth()->user();
    
        $partners = $user->allAcceptedPartners();

        return view('user.sessions.schedule-revision', compact('partners'));
    }

    /**
     * Store a newly created session.
     */
    public function store(Request $request)
    {
        $request->validate([
            'partner_name'=> 'required|string|max:255',
            'partner_id' => 'required|exists:users,id',
            'date'       => 'required|date',
            'start_time' => 'required|date_format:H:i',
            'end_time'   => 'required|date_format:H:i|after:start_time',
            'status'     => 'in:pending,confirmed,missed',
        ]);
        $user = auth()->user();
        $userId = auth()->id();
        $partnerId = $request->partner_id;

        // Check for conflicts for both user and partner
        $hasConflict = \App\Models\RevisionSession::where('date', $request->date)
            ->where(function ($q) use ($userId, $partnerId) {
                $q->where('user_id', $userId)
                  ->orWhere('partner_id', $userId)
                  ->orWhere('user_id', $partnerId)
                  ->orWhere('partner_id', $partnerId);
            })
            ->where(function ($q) use ($request) {
                $q->whereBetween('start_time', [$request->start_time, $request->end_time])
                  ->orWhereBetween('end_time', [$request->start_time, $request->end_time])
                  ->orWhere(function ($q2) use ($request) {
                      $q2->where('start_time', '<', $request->start_time)
                         ->where('end_time', '>', $request->end_time);
                  });
            })
            ->exists();

        if ($hasConflict) {
            return back()->with('error', 'Either you or your partner already have a session at this time.');
        }

        // Create the session if no conflict
        RevisionSession::create([
            'name'       => $request->partner_name,
            'user_name' => auth()->user()->name,
            'user_id'    => auth()->id(),
            'partner_id' => $request->partner_id,
            'date'       => $request->date,
            'time'       => $request->start_time,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
            'status'     => $request->status ?? 'pending',
        ]);
        $requestreceiver = User::find($request->partner_id);
        $requestreceiver->notify(new BaseNotification([
            'subject' => 'Revision Session accepted',
             'message' => 'Your revision session with ' . $user->name . ' has been scheduled.',
             'url' => route('calendar.index')
 ]));
        return redirect()->route('user.dashboard')->with('success', 'Session created successfully.');
    }

    /**
     * Update a session.
     */
    public function accept(RevisionSession $session)
    {
        try {
            $this->authorize('allow', $session);

            // Update the session status to 'confirmed'
            $session->status = 'confirmed';
            $session->save();

            // Get the user who sent the session request
            $requestSender = User::find($session->user_id);
            // Get the user who accepted the session
            $user = auth()->user();
            // Notify the user who sent the request
            $requestSender->notify(new BaseNotification([
                'subject' => 'Revision Session Accepted',
                'message' => 'Your revision session with ' . $user->name . ' has been accepted.',
                'url' => route('calendar.index')
            ]));

            return response()->json([
                'status' => 'success',
                'message' => 'The session has been successfully accepted.',
            ], 200);

        } catch (\Illuminate\Auth\Access\AuthorizationException $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'You are not authorized to accept this session.',
            ], 403);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'An error occurred while accepting the session. Please try again later.',
            ], 500);
        }
    }

    /**
     * (Optional) Decline a session.
     */
    public function decline(RevisionSession $session)
    {
        try {
            $this->authorize('allow', $session);

            $session->status = 'declined';
            $session->save();

            // Get the user who sent the session request
            $requestSender = User::find($session->user_id);
            // Get the user who declined the session
            $user = auth()->user();
            // Notify the user who sent the request
            $user->notify(new BaseNotification([
                'subject' => 'Revision Session declined',
                'message' => 'Your revision session with ' . $user->name . '   has been declined.',
                'url' => route('calendar.index')
            ]));

            return response()->json([
                'status' => 'success',
                'message' => 'The session has been successfully declined.',
            ], 200);
            
                 
        } catch (\Illuminate\Auth\Access\AuthorizationException $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'You are not authorized to decline this session.',
            ], 403);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'An error occurred while declining the session. Please try again later.',
            ], 500);
        }
    }

    /**
     * Cancel a session.
     */
    public function cancel(RevisionSession $session)
    {
        try {
            $this->authorize('cancel', $session);

            $session->status = 'cancelled';
            $session->save();

            // Get the user who sent the session request
            $requestSender = User::find($session->user_id);

            // Get the user who cancelled the session
            $user = auth()->user();
            $requestuser = User::find($session->partner_id);
            // Notify the user request was  sent to
            if ($user == $requestSender) {
                $requestuser->notify(new BaseNotification([
                    'subject' => 'Revision Session Cancelled',
                    'message' => 'Your revision session with ' . $user->name . ' has been cancelled.',
                    'url' => route('calendar.index')
                ]));
            }else {
                $requestSender->notify(new BaseNotification([
                'subject' => 'Revision Session declined',
                'message' => 'Your revision session with ' . $user->name . '   has been Cancelled.',
                'url' => route('calendar.index')
            ]));
            }
            return response()->json([
                'status' => 'success',
                'message' => 'The session has been successfully cancelled.',
            ], 200);

            
        } catch (\Illuminate\Auth\Access\AuthorizationException $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'You are not authorized to cancel this session.',
            ], 403);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'An error occurred while cancelling the session. Please try again later.',
            ], 500);
        }
    }
}

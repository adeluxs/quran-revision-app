<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RevisionSession;
use App\Models\User;
use App\Models\Partner;
use Carbon\Carbon;


class DashboardController extends Controller
{
    public function dashboard(Request $request)
    {
    
    $user = auth()->user();

        // Here you would fetch real-time data like sessions completed, badges, etc.
    $completed_sessions = 15; // Sample data
    $total_sessions = 30;    // Sample data
    $progress = ($completed_sessions / $total_sessions) * 100;
    

    $year = $request->get('year', now()->year);
    $month = $request->get('month', now()->month);

    $date = Carbon::create($year, $month, 1);
    // Fetch sessions for the authenticated user
    // and group them by date
    $sessions = \App\Models\RevisionSession::whereYear('date', $year)
        ->whereMonth('date', $month)
        ->where(function ($q) use ($user) {
            $q->where('user_id', $user->id)->orWhere('partner_id', $user->id);
        })
        ->get()
        ->groupBy(function ($session) {
            return (int) Carbon::parse($session->date)->format('d');
        });
    

       //shows the partner requests
    // Fetch partner requests for the authenticated user
    // and filter them based on the request parameters

    $query = Partner::with('user')->where('partner_id', $user->id);

    if ($request->filled('gender')) {
        $query->whereHas('user', function ($q) use ($request) {
            $q->where('gender', $request->gender);
        });
    }

    if ($request->filled('subject')) {
        $query->where('subject', $request->subject);
    }

    $partnerRequests = $query->orderByDesc('created_at')->get();

    
    

        return view('user.dashboard', compact('user', 'completed_sessions', 'total_sessions', 'progress','partnerRequests'), [
            'sessions' => $sessions,
            'year' => $year,
            'month' => $date->format('F'),
            'monthNumber' => $date->month,
            'daysInMonth' => $date->daysInMonth,
            'firstDay' => $date->startOfMonth()->dayOfWeek, // Sunday = 0, Monday = 1, etc.
        ]);
    }
}

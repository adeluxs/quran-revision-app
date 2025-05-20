<?php

namespace App\Http\Controllers;

use App\Http\Controllers\BaseNotification;
use Illuminate\Http\Request;
use App\Models\Partner;
use App\Models\User;


class PartnerController extends Controller
{
    
    // partners lists
    

    public function myPartners()
    {
        $user = auth()->user();
    
        $partners = $user->acceptedPartners()->get();
    
        return view('user.sessions.schedule-revision', compact('partners'));
    }


 //  send partner Request


public function sendRequest(Request $request)
{
    $request->validate([
        'partner_id' => 'required|exists:users,id',
    ]);

    Partner::updateOrCreate(
        [
            'user_id' => auth()->id(),
            'partner_id' => $request->partner_id,
        ],
        ['status' => 'pending']
    );
    // getting the user request was sent to
    $partner = User::find($request->partner_id);
    // getting the user who sent the request
    $user = auth()->user();
    // Optionally notify the user
    $partner->notify(new BaseNotification([
        'subject' => 'Pertner Request',
         'message' => 'Pertner Request From ' . $user ->name . '.',
         'url' => route('calendar.index')
 ]));

    return redirect()->back()->with('success', 'Partner request sent successfully!');
}


 /**
     * Accept a partner request.
     */
    public function accept($id)
    {
        $request = Partner::findOrFail($id);

        // check if authorize that the logged-in user is the intended partner
        if ($request->partner_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        $request->status = 'accepted';
        $request->save();
        //getting the user who accepted the request
        $partner = User::find($request->partner_id);
        // geeting the user who sent the request
        $user = User::find($request->user_id);
        // Optionally notify the user
        $user->notify(new BaseNotification([
            'subject' => 'Pertner Request Accepted',
             'message' => 'Pertner Requested From  ' . $partner->name . ' has been accepted.',
             'url' => route('calendar.index')
     ]));
    
        return redirect()->back()->with('success', 'Partner request accepted successfully.');
    }

    /**
     * Decline a partner request.
     */
    public function decline($id)
    {
        $request = Partner::findOrFail($id);

        if ($request->partner_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        $request->status = 'declined';
        $request->save();
        
        //getting the user who delined the request
        $partner = User::find($request->partner_id);
        // geeting the user who sent the request
        $user = User::find($request->user_id);
        // Optionally notify the user
        $user->notify(new BaseNotification([
            'subject' => 'Pertner Request Declined',
             'message' => 'Pertner Requested From  ' . $partner->name . ' has been Declined.',
             'url' => route('calendar.index')
     ]));
        return redirect()->back()->with('info', 'Partner request declined.');
    }

}

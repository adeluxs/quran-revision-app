<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class ProfileController extends Controller
{
    /**
     * Show the edit profile form.
     */
    public function edit()
    {
        return view('user.profile.edit', ['user' => auth()->user()]);
    }

    /**
     * Update the user's profile.
     */
    public function update(Request $request)
    {
        $request->validate([
            'country' => 'required|string|max:255',
            'memorized_juz' => 'required|array',
            'memorized_juz.*' => 'string|max:3', // e.g., "1", "30"
            'available_days' => 'required|array',
            'available_days.*' => 'string|max:10',
            'available_time' => 'nullable|string|max:50',
            'bio' => 'nullable|string|max:500',
        ]);

        $user = auth()->user();

        $user->update([
            'country' => $request->country,
            'memorized_juz' => $request->memorized_juz,
            'available_days' => $request->available_days,
            'available_time' => $request->available_time,
            'bio' => $request->bio,
        ]);

        return redirect()->back()->with('success', 'Profile updated!');
    }
}

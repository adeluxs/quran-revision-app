<?php

namespace App\Http\Controllers;

use App\Notifications\BaseNotification;
use Illuminate\Http\Request;
use App\Models\User;


class MatchController extends Controller
{
    public function index()
{
    $user = auth()->user();
    $partners = $user->matchablePartners();

    return view('user.match-partner', compact('partners'));
}

}

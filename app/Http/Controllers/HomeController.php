<?php

namespace App\Http\Controllers;

use App\Team;
use Auth;
use App\Individual;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        $individual = Individual::with('teams')->where('user_id', Auth::user()->id)->first();
        $keyResults = $individual->keyResults();
        $teams = $individual->teams;
        if ($teams->count() === 0) {
            return redirect()->route('team.join');
        }
        return view('home')->with(compact('keyResults', 'teams'));
    }
}

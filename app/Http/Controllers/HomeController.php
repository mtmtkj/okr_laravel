<?php

namespace App\Http\Controllers;

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

        return view('home')->with(compact('keyResults', 'teams'));
    }
}

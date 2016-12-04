<?php

namespace App\Http\Controllers;

use Auth;
use App\Individual;
use Illuminate\Contracts\View\View;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return View
     */
    public function index()
    {
        $individual = Individual::with('teams')->where('user_id', Auth::user()->id)->first();
        $teams = $individual->teams;

        return view('home')->with(compact('teams'));
    }
}

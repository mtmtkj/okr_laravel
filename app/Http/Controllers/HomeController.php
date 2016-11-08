<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use App\Individual;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $individual = Individual::with('teams')->where('user_id', Auth::user()->id)->first();
        $teams = $individual->teams;

        return view('home')->with(compact('teams'));
    }
}

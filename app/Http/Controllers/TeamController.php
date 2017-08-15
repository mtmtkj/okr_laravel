<?php

namespace App\Http\Controllers;

use App\Individual;
use App\Team;
use Illuminate\Http\Request;

class TeamController extends Controller
{
    /**
     * Team を表示する
     *
     * @param int $id Team の ID
     * @return \Illuminate\Contracts\View\View
     */
    public function show(int $id)
    {
        $team = Team::with('individuals')->findOrFail($id);

        return view('team.show')->with(compact('team'));
    }

    public function joinForm()
    {
        return view('team.join');
    }
}

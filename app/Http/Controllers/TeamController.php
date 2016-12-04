<?php

namespace App\Http\Controllers;

use App\Team;

class TeamController extends Controller
{
    /**
     * Team を表示する
     *
     * @param int $id Team の ID
     * @return \Illuminate\View\View
     */
    public function show(int $id)
    {
        $team = Team::with('individuals')->findOrFail($id);

        return view('team.show')->with(compact('team'));
    }
}

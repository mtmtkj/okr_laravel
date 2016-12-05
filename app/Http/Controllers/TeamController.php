<?php

namespace App\Http\Controllers;

use App\Team;

class TeamController extends Controller
{
    public function show(int $id)
    {
        $team = Team::with('individuals')->findOrFail($id);

        return view('team.show')->with(compact('team'));
    }
}

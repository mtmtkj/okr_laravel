<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Team;
use App\Http\Requests\ObjectiveRequest;

class ObjectiveController extends Controller
{
    public function create($teamId)
    {
        $team = Team::findOrFail($teamId);

        return view('team.objective.create')->with(compact('team'));
    }

    public function store(ObjectiveRequest $request)
    {
        $attrs = $request->except('_token');

        return $attrs;
    }
}

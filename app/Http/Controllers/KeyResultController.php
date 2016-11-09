<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Objective;
use App\KeyResult;

class KeyResultController extends Controller
{
    public function create($objectiveId)
    {
        $objective = Objective::findOrFail($objectiveId);

        return view('keyresult.create')->with(compact('objective'));
    }

    public function store(Request $request, $objectiveId)
    {
        $attrs = ['objective_id' => $objectiveId] + $request->except('_token');

        $keyresult = new KeyResult();
        $keyresult->fill($attrs);
        $keyresult->save();

        return redirect()->route('objective.show', $objectiveId);
    }
}

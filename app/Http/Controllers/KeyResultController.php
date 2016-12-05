<?php

namespace App\Http\Controllers;

use App\Http\Requests\KeyResultRequest;
use App\Objective;
use App\KeyResult;

class KeyResultController extends Controller
{
    public function create($objectiveId)
    {
        $objective = Objective::findOrFail($objectiveId);

        return view('keyresult.create')->with(compact('objective'));
    }

    public function store(KeyResultRequest $request, $objectiveId)
    {
        $attrs = ['objective_id' => $objectiveId] + $request->except('_token');

        $keyresult = new KeyResult();
        $keyresult->fill($attrs);
        $keyresult->save();

        return redirect()->route('objective.show', $objectiveId);
    }

    public function show($id)
    {
        $keyResult = KeyResult::findOrFail($id);
        $owner = $keyResult->objective->ownable;

        return view('keyresult.show')->with(compact('keyResult', 'owner'));
    }
}

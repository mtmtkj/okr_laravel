<?php

namespace App\Http\Controllers;

use Auth;
use DB;
use App\Http\Requests\IndividualObjectiveRequest;
use App\Models\KeyResult;
use App\Models\Objective;

class IndividualObjectiveController extends Controller
{
    public function create()
    {
        $parentKeyResults = KeyResult::belongsToTeamsOfIndividual(Auth::user()->individual)->get();

        return view('objective.create')->with(compact('parentKeyResults'));
    }

    public function store(IndividualObjectiveRequest $request)
    {
        $attrs = $request->data();
        $individual = Auth::user()->individual;

        DB::transaction(function () use ($attrs, $individual) {
            $objective = new Objective;
            $objective->fill($attrs['objective']);
            $individual->objectives()->save($objective);
            $attrs['key_result']['objective_id'] = $objective->id;
            $keyResult = new KeyResult;
            $keyResult->fill($attrs['key_result']);
            $keyResult->save();
        });

        return redirect()->route('home');
    }
}

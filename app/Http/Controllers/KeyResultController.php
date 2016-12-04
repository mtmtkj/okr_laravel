<?php

namespace App\Http\Controllers;

use App\Http\Requests\KeyResultRequest;
use App\Objective;
use App\KeyResult;

class KeyResultController extends Controller
{
    /**
     * Objective に紐付いた KeyResult を作成するフォームを表示する
     *
     * @param int $objectiveId KeyResult に紐付ける Objective の ID
     * @return \Illuminate\View\View
     */
    public function create($objectiveId)
    {
        $objective = Objective::findOrFail($objectiveId);

        return view('keyresult.create')->with(compact('objective'));
    }

    /**
     * KeyResult を保存する
     *
     * @param KeyResultRequest $request KeyResult の属性を持つ FormRequest
     * @param int $objectiveId KeyResult に紐付ける Objective の ID
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(KeyResultRequest $request, $objectiveId)
    {
        $attrs = ['objective_id' => $objectiveId] + $request->except('_token');

        $keyresult = new KeyResult();
        $keyresult->fill($attrs);
        $keyresult->save();

        return redirect()->route('objective.show', $objectiveId);
    }

    /**
     * KeyResult を表示する
     *
     * @param int $id KeyResult の ID
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $keyResult = KeyResult::findOrFail($id);
        $owner = $keyResult->objective->ownable;

        return view('keyresult.show')->with(compact('keyResult', 'owner'));
    }
}

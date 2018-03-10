<?php

namespace App\Http\Controllers;

use App\Http\Requests\TeamObjectiveRequest;
use App\Models\Team;
use App\Models\Objective;

class TeamObjectiveController extends Controller
{
    /**
     * Team に紐付いた Objective を作成するフォームを表示する
     *
     * @param int $teamId Objective に紐付ける Team の ID
     * @return \Illuminate\Contracts\View\View
     */
    public function create($teamId)
    {
        $team = Team::findOrFail($teamId);

        return view('team.objective.create')->with(compact('team'));
    }

    /**
     * Objective を保存する
     *
     * @param TeamObjectiveRequest $request Objective の属性を持つ FormRequest
     * @param int $teamId Objective に紐付ける Team の ID
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(TeamObjectiveRequest $request, $teamId)
    {
        $team = Team::findOrFail($teamId);
        $attrs = $request->except('_token');
        $objective = new Objective;
        $objective->fill($attrs);
        $team->objectives()->save($objective);

        return redirect()->route('team.show', $teamId);
    }

    /**
     * Objective を表示する
     *
     * @param int $id Objective の ID
     * @return \Illuminate\Contracts\View\View
     */
    public function show($id)
    {
        $objective = Objective::findOrFail($id);
        $owner = $objective->ownable;

        return view('objective.show')->with(compact('objective', 'owner'));
    }
}

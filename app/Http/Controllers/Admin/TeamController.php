<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\TeamRequest;
use App\Team;

class TeamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        $teams = Team::all();
        return view('admin.team.index')->with(compact('teams'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function create()
    {
        $team = new Team();

        return $this->form($team);
    }

    /**
     * フォームを表示する
     *
     * @param Team $team
     * @return \Illuminate\Contracts\View\View
     */
    private function form(Team $team)
    {
        $edit = ($team->id !== null);
        $title = ($edit) ? 'Edit' : 'Create';
        $actionMethod = ($edit) ? 'PUT' : 'POST';
        $actionUrl = ($edit) ? route('admin.teams.update', $team->id) : route('admin.teams.store');
        $btnSaveLabel = ($edit) ? 'Update' : 'Create';

        return view('admin.team.form')->with(compact('team', 'title', 'actionMethod', 'actionUrl', 'btnSaveLabel'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Admin\TeamRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(TeamRequest $request)
    {
        $attrs = $request->data();
        $team = Team::create($attrs);

        return redirect()->route('admin.teams.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\View\View
     */
    public function edit($id)
    {
        $team = Team::findOrFail($id);

        return $this->form($team);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Admin\TeamRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(TeamRequest $request, $id)
    {
        $attrs = $request->data();
        $team = Team::findOrFail($id);
        $team->fill($attrs);
        $team->save();

        return redirect()->route('admin.teams.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $team = Team::findOrFail($id);
        $team->delete();

        return redirect()->route('admin.teams.index');
    }
}

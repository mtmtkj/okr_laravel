<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\InputPeriodRequest;
use App\InputPeriod;
use App\ObjectiveOwnerTypes;

class InputPeriodController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        $inputPeriods = InputPeriod::orderBy('start_at')->get();

        return view('admin.input_period.index')->with(compact('inputPeriods'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function create()
    {
        $inputPeriod = new InputPeriod();
        $objectiveOwnerTypes = [0 => '--- Choose one ---'] + ObjectiveOwnerTypes::all();

        return $this->form($inputPeriod, $objectiveOwnerTypes);
    }

    /**
     * フォームを表示する
     *
     * @param InputPeriod $inputPeriod
     * @param array $objectiveOwnerTypes
     * @return \Illuminate\Contracts\View\View
     */
    public function form(InputPeriod $inputPeriod, array $objectiveOwnerTypes)
    {
        $edit = ($inputPeriod->id !== null);
        $title = ($edit) ? 'Edit' : 'Create';
        $actionMethod = ($edit) ? 'PUT' : 'POST';
        $actionUrl = ($edit) ? route('admin.input_periods.update', $inputPeriod->id) : route('admin.input_periods.store');
        $btnSaveLabel = ($edit) ? 'Update' : 'Create';

        return view('admin.input_period.form')->with(compact('inputPeriod', 'objectiveOwnerTypes', 'title', 'actionMethod', 'actionUrl', 'btnSaveLabel'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(InputPeriodRequest $request)
    {
        $attrs = $request->data();
        $inputPeriod = InputPeriod::create($attrs);

        return redirect()->route('admin.input_periods.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\View\View
     */
    public function edit($id)
    {
        $inputPeriod = InputPeriod::findOrFail($id);
        $objectiveOwnerTypes = [0 => '--- Choose one ---'] + ObjectiveOwnerTypes::all();

        return $this->form($inputPeriod, $objectiveOwnerTypes);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(InputPeriodRequest $request, $id)
    {
        $attrs = $request->data();
        $inputPeriod = InputPeriod::findOrFail($id);
        $inputPeriod->fill($attrs);
        $inputPeriod->save();

        return redirect()->route('admin.input_periods.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $inputPeriod = InputPeriod::findOrFail($id);
        $inputPeriod->delete();

        return redirect()->route('admin.input_periods.index');
    }
}

<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\InputPeriodRequest;
use App\InputPeriod;
use App\EvaluateeTypes;

class InputPeriodController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $inputPeriods = InputPeriod::orderBy('start_at')->get();

        return view('admin.input_period.index')->with(compact('inputPeriods'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $inputPeriod = new InputPeriod();
        $evaluateeTypes = [0 => '--- Choose one ---'] + EvaluateeTypes::all();

        return $this->form($inputPeriod, $evaluateeTypes);
    }

    public function form(InputPeriod $inputPeriod, array $evaluateeTypes)
    {
        $edit = ($inputPeriod->id !== null);
        $title = ($edit) ? 'Edit' : 'Create';
        $actionMethod = ($edit) ? 'PUT' : 'POST';
        $actionUrl = ($edit) ? route('admin.input_periods.update', $inputPeriod->id) : route('admin.input_periods.store');
        $btnSaveLabel = ($edit) ? 'Update' : 'Create';

        return view('admin.input_period.form')->with(compact('inputPeriod', 'evaluateeTypes', 'title', 'actionMethod', 'actionUrl', 'btnSaveLabel'));
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

        return $inputPeriod;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $inputPeriod = InputPeriod::findOrFail($id);
        $evaluateeTypes = [0 => '--- Choose one ---'] + EvaluateeTypes::all();

        return $this->form($inputPeriod, $evaluateeTypes);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
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
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $inputPeriod = InputPeriod::findOrFail($id);
        $inputPeriod->delete();

        return redirect()->route('admin.input_periods.index');
    }
}

@extends('admin.layout')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-12">
      {!! Form::open(['method' => $actionMethod, 'url' => $actionUrl]) !!}
      <div class="panel panel-default">
        <div class="panel-heading"><h2>{{ $title }} Input Period</h2></div>
        <div class="panel-body">
          <table class="table">
            <tbody>
              <tr>
                <th>{!! Form::label('name') !!}</th>
                <td>{!! Form::text('name', $inputPeriod->name, ['class' => 'form-control']) !!}</td>
              </tr>
              <tr>
                <th>{!! Form::label('evaluatee_type') !!}</th>
                <td>{!! Form::select('evaluatee_type', $evaluateeTypes, $inputPeriod->evaluatee_type, ['class' => 'form-control']) !!}</td>
              </tr>
              <tr>
                <th>{!! Form::label('start_at') !!}</th>
                <td>{!! Form::text('start_at', $inputPeriod->start_at, ['class' => 'form-control']) !!}</td>
              </tr>
              <tr>
                <th>{!! Form::label('end_at') !!}</th>
                <td>{!! Form::text('end_at', $inputPeriod->end_at, ['class' => 'form-control']) !!}</td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
      <div class="panel-footer">
        {!! Form::submit($btnSaveLabel, ['class' => 'btn btn-primary']) !!}
      </div>
      {!! Form::close() !!}
    </div>
  </div>
</div>
@endsection
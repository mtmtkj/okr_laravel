@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-8 col-md-offset-2">
      {!! Form::open() !!}
      <div class="panel panel-default">
        <div class="panel-heading">Objective: {{ $objective->subject }}</div>
        <div class="panel-body">
          <h4>Key Result</h4>
          <div class="form-group">
            {!! Form::label('subject') !!}
            {!! Form::text('subject', null, ['class' => 'form-control']) !!}
          </div>
          <div class="form-group">
            {!! Form::label('description') !!}
            {!! Form::textarea('description', null, ['class' => 'form-control']) !!}
          </div>
          <div class="form-group">
            {!! Form::label('target') !!}
            <div class="row">
              <div class="col-sm-4">
                {!! Form::label('value') !!}
                {!! Form::text('target_value', null, ['class' => 'form-control']) !!}
              </div>
              <div class="col-sm-2">
                {!! Form::label('unit') !!}
                {!! Form::text('target_unit', null, ['class' => 'form-control']) !!}
              </div>
            </div>
          </div>
        </div>
        <div class="panel-footer">
          {!! Form::submit('Add', ['class' => 'btn btn-primary']) !!}
        </div>
      </div>
      {!! Form::close() !!}
    </div>
  </div>
</div>
@endsection
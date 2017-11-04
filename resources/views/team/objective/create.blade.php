@extends('layouts.app')

@section('content')
<div>
  <div class="row">
    <div class="col-lg-12">
      {!! Form::open(['route' => ['team.objective.create', $team->id], 'method' => 'POST']) !!}
      <div class="panel panel-default">
        <div class="panel-heading">{{ $team->name }}</div>
        <div class="panel-body">
          <div class="form-group">
            {!! Form::label('subject') !!}
            {!! Form::text('subject', null, ['class' => 'form-control']) !!}
          </div>
          <div class="form-group">
            {!! Form::label('description') !!}
            {!! Form::textarea('description', null, ['class' => 'form-control']) !!}
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
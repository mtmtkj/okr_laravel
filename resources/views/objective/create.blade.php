@extends('layouts.app')

@section('content')
<div>
  @if (count($errors) > 0)
  <div class="alert alert-danger">
    <ul>
    @foreach ($errors->all() as $error)
      <li>{{ $error }}</li>
    @endforeach
    </ul>
  </div>
  @endif
  <div class="row">
    <div class="col-lg-12">
      {!! Form::open(['route' => ['individual.objective.store'], 'method' => 'POST']) !!}
      <div class="panel panel-default">
        <div class="panel-heading">Create your objective</div>
        <div class="panel-body">
          <div class="form-group">
            <h4>Your team's key result</h4>
            <ul class="list-group">
            @foreach ($parentKeyResults as $kr)
              <li class="list-group-item">
                {!! Form::radio('parent_key_result_id', $kr->id, false, ['class' => 'form-inline', 'id' => 'parent_key_result_id_' . $kr->id]) !!}
                {!! Form::label('parent_key_result_id_' . $kr->id, $kr->subject) !!}
              </li>
            @endforeach
            </ul>
          </div>

          <h4>Objective</h4>
          <div class="form-group">
            {!! Form::label('subject') !!}
            {!! Form::text('objective[subject]', null, ['class' => 'form-control']) !!}
          </div>
          <div class="form-group">
            {!! Form::label('description') !!}
            {!! Form::textarea('objective[description]', null, ['class' => 'form-control', 'rows' => '4']) !!}
          </div>

          <h4>Key Result</h4>
          <div class="form-group">
            {!! Form::label('subject') !!}
            {!! Form::text('key_result[subject]', null, ['class' => 'form-control']) !!}
          </div>
          <div class="form-group">
            {!! Form::label('description') !!}
            {!! Form::textarea('key_result[description]', null, ['class' => 'form-control', 'rows' => '4']) !!}
          </div>
          <div class="form-group">
            {!! Form::label('target') !!}
            <div class="row">
              <div class="col-sm-4">
                {!! Form::label('value') !!}
                {!! Form::text('key_result[target_value]', null, ['class' => 'form-control']) !!}
              </div>
              <div class="col-sm-2">
                {!! Form::label('unit') !!}
                {!! Form::text('key_result[target_unit]', null, ['class' => 'form-control']) !!}
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

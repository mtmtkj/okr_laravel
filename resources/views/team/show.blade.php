@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-8 col-md-offset-2">
      <div class="panel panel-default">
        <div class="panel-heading">{{ $team->name }}</div>
        <div class="panel-body">
          <p><a href="{{ route('team.objective.create', $team->id) }}">Create a new objective</a></p>
          <ul class="list-group">
          @foreach ($team->individuals as $individual)
            <li class="list-group-item">
              <a href="{{ $individual->id }}">{{ $individual->user->name }}</a>
            </li>
          @endforeach
          </ul>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
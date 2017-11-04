@extends('layouts.app')

@section('content')
<div>
  <div class="row">
    <div class="col-lg-12">
      <div class="panel panel-default">
        <div class="panel-heading">{{ $team->name }}</div>
        <div class="panel-body">
          <h4>Objectives</h4>
          <p><a href="{{ route('team.objective.create', $team->id) }}">Create a new objective</a></p>
          <ul class="list-group list-striped">
          @foreach ($team->objectives as $objective)
            <li class="list-group-item">
              <a href="{{ route('objective.show', $objective->id) }}">{{ $objective->subject }}</a>
            </li>
          @endforeach
          </ul>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
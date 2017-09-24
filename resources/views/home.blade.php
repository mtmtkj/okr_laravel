<?php
use App\Services\Timeline;
?>
@extends('layouts.app')

@section('content')
<div class="container content-home">
  <div class="row">
    <div class="col-md-8 col-md-offset-2">
      <div class="panel panel-default">
        <div class="panel-heading">Dashboard</div>
        <div class="panel-body">
          You are logged in!
        </div>
      </div>

      <div class="panel panel-default">
        <div class="panel-heading">Your OKR
          @if (app(Timeline::class)->canInput())
            <a class="add-okr-link" href="{{ route('individual.objective.create') }}"><i class="glyphicon glyphicon-plus"></i></a>
          @endif
        </div>
        <div class="panel-body">
          <ul class="list-group">
          @foreach ($keyResults as $keyResult)
            <li class="list-group-item">
              <div class="row">
                <div class="col-md-6">
                  <a href="{{ route('keyresult.show', $keyResult->id) }}">{{ $keyResult->subject }}({{ $keyResult->objective->subject }})</a>
                </div>
                <div class="col-md-3 text-right">
                  {{ $keyResult->target_value }} {{ $keyResult->target_unit }}
                </div>
                <div class="col-md-3">
                  <div class="progress">
                    <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="{{ $keyResult->currentFulfillmentPercentage() }}" aria-valuemin="0" aria-valuemax="100" style="width: {{ $keyResult->currentFulfillmentPercentage() }}%;">
                    </div>
                  </div>
                </div>
              </div>
            </li>
          @endforeach
          </ul>
        </div>
      </div>

      <div class="panel panel-default">
        <div class="panel-heading">Your Team</div>
        <div class="panel-body">
        @if (count($teams) > 0)
          <ul class="list-group">
          @foreach ($teams as $team)
            <li class="list-group-item"><a href="{{ route('team.show', $team->id) }}">{{ $team->name }}</a></li>
          @endforeach
          </ul>
        @else
          <p>You are not in any team yet, so join a team!</p>
        @endif
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

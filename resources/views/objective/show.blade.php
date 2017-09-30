<?php
use App\Services\Timeline;
?>
@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-8 col-md-offset-2">
      <div class="panel panel-default">
        <div class="panel-heading">Subject: {{ $objective->subject }} - Owner: {{ $owner->name }}</div>
        <div class="panel-body">
          <h4>Description</h4>
          {{ $objective->description }}
        </div>
      </div>

      <div class="panel panel-default">
        <div class="panel-heading">Key Results</div>
        <div class="panel-body">
          @if (app(Timeline::class)->canInput())
            <p><a href="{{ route('objective.keyresult.create', $objective->id) }}">Create a new key result</a></p>
          @endif
          <ul class="list-group list-striped">
          @foreach ($objective->keyResults as $keyResult)
            <li class="list-group-item"><a href="{{ route('keyresult.show', $keyResult->id) }}">{{ $keyResult->subject }}</a></li>
          @endforeach
          </ul>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
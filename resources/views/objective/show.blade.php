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
          <ul class="list-group">
          @foreach ($objective->keyResults as $keyResult)
            <li class="list-group-item">{{ $keyResult->subject }}</li>
          @endforeach
          </ul>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
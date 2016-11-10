@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-8 col-md-offset-2">
      <div class="panel panel-default">
        <div class="panel-heading">Subject: {{ $keyResult->subject }} - Owner: {{ $owner->name }}</div>
        <div class="panel-body">
          <h4>Description</h4>
          {{ $keyResult->description }}

          <h4>Objective</h4>
          {{ $keyResult->objective->subject }}
        </div>
      </div>

      <div class="panel panel-default">
        <div class="panel-heading">Fulfillment</div>
        <div class="panel-body">
        0 %
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-8 col-md-offset-2">
      <div class="panel panel-default">
        <div class="panel-heading">
          <div class="row">
            <h3 class="col-sm-8">Subject: {{ $keyResult->subject }}</h3>
            <div class="col-sm-4">Owner: {{ $owner->name }}</div>
          </div>
        </div>
        <div class="panel-body">
          <h4>Description</h4>
          {{ $keyResult->description }}

          <h4>Objective</h4>
          {{ $keyResult->objective->subject }}

        </div>
      </div>

      <div class="panel panel-default">
        <div class="panel-heading"><h3>Fulfilment</h3></div>
        <div class="panel-body">
          <h4>Target</h4>
          {{ $keyResult->target_value }} {{ $keyResult->target_unit }}
          <h4>Fulfilment</h4>
          <div class="progress">
            <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="{{ $keyResult->currentFulfilmentPercentage() }}" aria-valuemin="0" aria-valuemax="100" style="width: {{ $keyResult->currentFulfilmentPercentage() }}%;">
              {{ $keyResult->currentFulfilmentPercentage() }}%
            </div>
          </div>

          <h4>Records</h4>
          <ul>
          @foreach ($keyResult->fulfilment_histories as $history)
            <li>{{ $history->created_at }} {{ $history->fulfilled_value }} {{ $keyResult->target_unit }}</li>
          @endforeach
          </ul>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
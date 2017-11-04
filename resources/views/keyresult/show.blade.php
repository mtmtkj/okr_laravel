@extends('layouts.app')

@section('content')
<div>
  <div class="row">
    <div class="col-lg-12">
      <div class="panel panel-default">
        <div class="panel-heading">
          <div class="row">
            <div class="col-sm-8">
              <h3>Key Result: {{ $keyResult->subject }}</h3>
              <div class="description">
                {{ $keyResult->description }}
              </div>
            </div>
            <div class="col-sm-4">Owner: {{ $owner->name }}</div>
          </div>
        </div>
        <div class="panel-body">
          <h4>Objective</h4>
          {{ $keyResult->objective->subject }}
        </div>
      </div>

      <div class="panel panel-default">
        <div class="panel-heading"><h3>Fulfillment</h3></div>
        <div class="panel-body">
          <h4>Target</h4>
          {{ $keyResult->target_value }} {{ $keyResult->target_unit }}
          <h4>Fulfillment</h4>
          <div class="progress">
            <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="{{ $keyResult->currentFulfillmentPercentage() }}" aria-valuemin="0" aria-valuemax="100" style="width: {{ $keyResult->currentFulfillmentPercentage() }}%;">
              {{ $keyResult->currentFulfillmentPercentage() }}%
            </div>
          </div>

          <h4>Progress</h4>
          <ul>
          @foreach ($keyResult->fulfillment_progresses as $progress)
            <li>{{ $progress->created_at }} {{ $progress->fulfilled_value }} {{ $keyResult->target_unit }}</li>
          @endforeach
          </ul>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
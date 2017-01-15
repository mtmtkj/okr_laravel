@extends('admin.layout')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-12">
      <div class="panel panel-default">
        <div class="panel-heading"><h2>Dashboard</h2></div>
        <div class="panel-body">
          <ul>
            <li><a href="{{ route('admin.input_periods.index') }}">Input period</a></li>
            <li><a href="{{ route('admin.teams.index') }}">Team</a></li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
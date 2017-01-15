@extends('admin.layout')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-12">
      <div class="panel panel-default">
        <div class="panel-heading"><h2>Members - {{ $team->name }}</h2></div>
        <div class="panel-body">
          @if (!$members->isEmpty())
          <ul class="list-group">
          @foreach ($members as $member)
            <li class="list-group-item">{{ $member->name }}</li>
          @endforeach
          @else
          <p>No members registered.</p>
          @endif
          </ul>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
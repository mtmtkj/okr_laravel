@extends('layouts.app')

@section('content')
  <div class="container content-home">
    <div class="row">
      <div class="col-md-8 col-md-offset-2">
        <div class="panel panel-default">
          <div class="panel-heading">Join a Team!</div>
          <div class="panel-body">
            <ul class="list-group">
              @foreach ($teams as $team)
                <li class="list-group-item">
                  <div class="row">
                    <div class="col-lg-4">{{ $team->name }}</div>
                    <div class="col-lg-2"><button class="btn btn-primary">Join</button></div>
                  </div>
                </li>
              @endforeach
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
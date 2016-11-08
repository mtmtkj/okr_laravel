@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    You are logged in!
                </div>
            </div>

            <div class="panel panel-default">
                <div class="panel-heading">Your Team</div>
                <div class="panel-body">
                @if (count($teams) > 0)
                    <ul class="list-group">
                    @foreach ($teams as $team)
                        <li class="list-group-item">{{ $team->name }}</li>
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

@extends('layouts.app')
@section('content')
  <div class="container">
    @if (count($errors) > 0)
      <div class="alert alert-danger">
        <ul>
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif
    <div class="row">
      <div class="col-md-8 col-md-offset-2">
        {!! Form::open(['method' => 'POST', 'route' => 'organization.store']) !!}
        <div class="panel panel-default">
          <div class="panel-heading">Create your organization</div>
          <div class="panel-body">
            <input name="name" class="form-control" placeholder="Your organization name">
          </div>
          <div class="panel-footer">
            <button class="btn btn-primary">Add</button>
          </div>
        </div>
        {!! Form::close() !!}
      </div>
    </div>
  </div>
@endsection
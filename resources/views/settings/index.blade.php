@extends('layouts.app')

@section('content')
  <div class="content-home">
    <div class="row">
      <div class="col-lg-12">
        <div class="panel panel-default">
          <div class="panel-heading">Settings</div>
          <div class="panel-body">
            @if (session()->has('success'))
              <div class="alert alert-success">
                <p>{{ session()->get('success') }}</p>
              </div>
            @endif
            @if ($errors->any())
              <div class="alert alert-danger">
                <ul>
                  @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                  @endforeach
                </ul>
              </div>
            @endif
            {!! Form::open(['method' => 'POST']) !!}
              <table class="table">
                <tbody>
                <tr>
                  <th>Name</th>
                  <td>{!! Form::text('name', $user->name, ['class' => 'form-control']) !!}</td>
                </tr>
                <tr>
                  <th>Current Password</th>
                  <td>{!! Form::password('current_password', ['class' => 'form-control']) !!}</td>
                </tr>
                <tr>
                  <th>New Password</th>
                  <td>{!! Form::password('new_password', ['class' => 'form-control']) !!}</td>
                </tr>
                <tr>
                  <th>Confirm Password</th>
                  <td>{!! Form::password('new_password_confirmation', ['class' => 'form-control']) !!}</td>
                </tr>
                </tbody>
                <tfoot>
                <tr>
                  <td colspan="2">
                    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
                  </td>
                </tr>
                </tfoot>
              </table>
            {!! Form::close() !!}
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
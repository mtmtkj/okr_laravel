@extends('admin.layout')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-12">
      {!! Form::open(['method' => $actionMethod, 'url' => $actionUrl]) !!}
      <div class="panel panel-default">
        <div class="panel-heading"><h2>{{ $title }} Team</h2></div>
        <div class="panel-body">
          <table class="table">
            <tbody>
              <tr>
                <th>{!! Form::label('name') !!}</th>
                <td>
                  {!! Form::text('name', $team->name, ['class' => 'form-control']) !!}
                  @if ($errors->has('name'))
                  <div class="alert alert-danger">{{ $errors->first('name') }}</div>
                  @endif
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
      <div class="panel-footer">
        {!! Form::submit($btnSaveLabel, ['class' => 'btn btn-primary']) !!}
      </div>
      {!! Form::close() !!}
    </div>
  </div>
</div>
@endsection
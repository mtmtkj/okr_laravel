@extends('admin.layout')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-12">
      <table class="table table-striped">
        <thead>
          <tr>
            <th>Name</th>
            <th>Type</th>
            <th>Start</th>
            <th>End</th>
          </tr>
        </thead>
        <tbody>
        @foreach ($inputPeriods as $inputPeriod)
          <tr>
            <td>{{ $inputPeriod->name }}</td>
            <td>{{ $inputPeriod->evaluatee_type }}</td>
            <td>{{ $inputPeriod->start_at }}</td>
            <td>{{ $inputPeriod->end_at }}</td>
          </tr>
        @endforeach
        </tbody>
      </table>
    </div>
</div>
@endsection
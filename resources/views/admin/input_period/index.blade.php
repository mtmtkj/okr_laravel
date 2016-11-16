@extends('admin.layout')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-12">
      {!! Form::open(['method' => 'delete']) !!}
      <div class="panel panel-default">
        <div class="panel-heading"><h2>Input Periods</h2></div>
        <div class="panel-body">
          <p><a href="{{ route('admin.input_periods.create') }}">Create a New Entry</a></p>
          <table class="table table-striped">
            <thead>
              <tr>
                <th>Name</th>
                <th>Evaluatee Type</th>
                <th>Start At</th>
                <th>End At</th>
                <th>&nbsp;</th>
              </tr>
            </thead>
            <tbody>
            @foreach ($inputPeriods as $inputPeriod)
              <tr>
                <td>{{ $inputPeriod->name }}</td>
                <td>{{ $inputPeriod->evaluatee_type_label }}</td>
                <td>{{ $inputPeriod->start_at }}</td>
                <td>{{ $inputPeriod->end_at }}</td>
                <td>
                  <a href="{{ route('admin.input_periods.edit', $inputPeriod->id) }}" class="btn btn-info"><i class="glyphicon glyphicon-edit"></i></a>
                  <span class="btn btn-edit btn-danger" data-url="{{ route('admin.input_periods.destroy', $inputPeriod->id) }}"><i class="glyphicon glyphicon-remove"></i></span>
                </td>
              </tr>
            @endforeach
            </tbody>
          </table>
        </div>
      </div>
      {!! Form::close() !!}
    </div>
</div>
@endsection

@push('scripts')
<script>
(function ($) {
  $('.btn-edit').click(function () {
    $('form:eq(0)').attr('action', $(this).data('url'));
    $('form:eq(0)').submit();
  });
})(jQuery);
</script>
@endpush
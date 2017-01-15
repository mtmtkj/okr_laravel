@extends('admin.layout')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-12">
      <div class="panel panel-default">
        <div class="panel-heading"><h2>Teams</h2></div>
        <div class="panel-body">
          <p><a href="{{ route('admin.teams.create') }}">Create a New Team</a></p>
          <table class="table table-striped">
            <thead>
              <tr>
                <th>Name</th>
                <th>&nbsp;</th>
              </tr>
            </thead>
            <tbody>
            @foreach ($teams as $team)
              <tr>
                <td>{{ $team->name }}</td>
                <td>
                  <a href="{{ route('admin.teams.members.index', $team->id) }}" class="btn btn-info"><i class="glyphicon glyphicon-user"></i></a>
                  <a href="{{ route('admin.teams.edit', $team->id) }}" class="btn btn-info"><i class="glyphicon glyphicon-edit"></i></a>
                  <a href="{{ route('admin.teams.destroy', $team->id) }}" class="btn btn-edit btn-danger" data-method="delete"><i class="glyphicon glyphicon-remove"></i></a>
                </td>
              </tr>
            @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@push('scripts')
<script>
(function ($) {
  $('a[data-method="delete"]').click(function () {
    var href = $(this).attr('href');
    var form = $('<form method="post" action="' + href + '"></form>');
    var inputs = '<input type="hidden" name="_method" value="delete">';
    var token = $('meta[name="csrf-token"]').attr('content');
    inputs += '<input type="hidden" name="_token" value="' + token + '">';
    form.hide().append(inputs).appendTo('body');
    form.submit();
    return false;
  });
})(jQuery);
</script>
@endpush
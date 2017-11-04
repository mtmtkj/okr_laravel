@extends('layouts.app')

@section('content')
  <div class="content-home" id="joinTeamApp">
    <div class="row">
      <div class="col-lg-12">
        <div class="panel panel-default">
          <div class="panel-heading">Join a Team!</div>
          <div class="panel-body">
            {!! Form::hidden('individual_id', \Auth::user()->individual->id, ['id' => 'individual_id']) !!}
            {!! Form::hidden('api_token', \Auth::user()->api_token) !!}
            <div v-if="teams.length === 0">
              <h3>Create a new team</h3>
              <div class="form-inline">
                <input name="name" v-model="name" class="form-control" placeholder="team name">
                <button class="btn btn-primary" v-on:click="createNewTeam">Create</button>
              </div>
            </div>
            <ul v-else class="list-group">
              <li class="list-group-item" v-for="team in teams">
                <div class="row">
                  <div class="col-lg-4">@{{ team.name }}</div>
                  <div class="col-lg-2">
                    <button class="btn btn-primary"
                            id="js-btn-join"
                            :data-id="team.id"
                            v-on:click="joinTheTeam"
                            :disabled="team.joined == 1">
                      <span v-if="team.joined == 1"><i class="glyphicon glyphicon-ok"></i></span>
                      <span v-else>Join</span>
                    </button>
                  </div>
                </div>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
@push('script')
  <script src="/js/teamJoin.js"></script>
@endpush
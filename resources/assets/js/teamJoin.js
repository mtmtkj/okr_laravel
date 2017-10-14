const vm = new Vue({
  el: '#joinTeamApp',
  data: {
    name: null,
    teams: []
  },
  created: function () {
    const individualId = document.getElementById('individual_id').getAttribute('value');
    this.axios.get('/api/team', {params: {individualId: individualId}})
      .then(function (res) {
        this.teams = res.data;
      }.bind(this))
    },
  methods: {
    createNewTeam: function () {
      this.axios.post('/api/team', {name: this.name})
        .then(function (res) {
          let team = res.data;
          team.joined = 0;
          this.teams.push(team);
        }.bind(this));
    },
    joinTheTeam: function() {
      const teamId = document.getElementById('js-btn-join').getAttribute('data-id');
      this.axios.post('/api/team/join', {teamId: teamId})
        .then(function (res) {
          if (res.data.status === 'ok') {
            let team = this.teams.find(function (el) {
              return el.id === parseInt(teamId);
            });
            team.joined = 1;
          }
        }.bind(this))
    }
  }
});

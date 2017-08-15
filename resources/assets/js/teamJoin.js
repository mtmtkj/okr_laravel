const vm = new Vue({
  el: '#joinTeamApp',
  data: {
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
    joinTheTeam: function() {
      const teamId = document.getElementById('js-btn-join').getAttribute('data-id');
      this.axios.post('/api/team/join', {teamId: teamId})
          .then(function (res) {
            this.teams[teamId].joined = 1;
          }.bind(this))
    }
  }
});

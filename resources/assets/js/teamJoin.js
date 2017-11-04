const vm = new Vue({
  el: '#joinTeamApp',
  data: {
    name: null,
    teams: []
  },
  created () {
    const individualId = document.getElementById("individual_id").getAttribute("value");
    this.axios.get("/api/team", {params: {individualId: individualId}})
      .then((res) => {
        this.teams = res.data;
      })
    },
  methods: {
    createNewTeam () {
      this.axios.post("/api/team", {name: this.name})
        .then((res) => {
          let team = res.data;
          team.joined = 0;
          this.teams.push(team);
        });
    },
    joinTheTeam () {
      const teamId = document.getElementById("js-btn-join").getAttribute("data-id");
      this.axios.post("/api/team/join", {teamId: teamId})
        .then(() => {
          let team = this.teams.find(function (el) {
            return el.id === parseInt(teamId);
          });
          team.joined = 1;
        })
    }
  }
});

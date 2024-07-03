<template>
  <div id="matches" class="bg-gray-800">
    <h2>Football Match Schedule</h2>
    <div class="matches-grid">
      <div class="match" v-for="(match, index) in displayedMatches" :key="index">
        <div class="match-header text-center">
          <div>Group stage - Matchday 3 of 3</div>
        </div>
        <div class="teams">
          <div class="team">
            <img :src="match.team1.flag" alt="Team 1 Flag" />
            <span>{{ match.team1.name }}</span>
            <span>{{ match.team1.score }}</span>
          </div>
          <div class="team">
            <img :src="match.vsTeam" alt="" class="vsTeam" />
          </div>
          <div class="team">
            <img :src="match.team2.flag" alt="Team 2 Flag" />
            <span>{{ match.team2.name }}</span>
            <span>{{ match.team2.score }}</span>
          </div>
        </div>
        <div class="status">
          <div class="match-status">{{ match.status }}</div>
          <div class="match-time">{{ match.time }}</div>
        </div>
      </div>
    </div>
    <div class="more-matches">
      <button @click="toggleMatches">{{ buttonText }}</button>
    </div>
  </div>
</template>

<script>
import logoTeam1 from '../../assets/image/logo-team1.webp';
import logoTeam2 from '../../assets/image/logo-team2.jpg';
import Vsteam from '../../assets/image/vs.png';

export default {
  data() {
    return {
      matches: [
        {
          team1: { name: 'Bolivia', flag: logoTeam1, score: 0 },
          vsTeam: Vsteam,
          team2: { name: 'Panama', flag: logoTeam2, score: 1 },
          status: 'Live 50\'',
          time: ''
        },
        {
          team1: { name: 'USA', flag: logoTeam1, score: 0 },
          vsTeam: Vsteam,
          team2: { name: 'Uruguay', flag: logoTeam2, score: 0 },
          status: 'Half-time',
          time: ''
        },
        {
          team1: { name: 'USA', flag: logoTeam1, score: 0 },
          vsTeam: Vsteam,
          team2: { name: 'Uruguay', flag: logoTeam2, score: 0 },
          status: 'Tomorrow 8AM',
          time: ''
        },
        {
          team1: { name: 'Brazil', flag: logoTeam1, score: 0 },
          vsTeam: Vsteam,
          team2: { name: 'Colombia', flag: logoTeam2, score: 0 },
          status: '',
          time: 'Tomorrow 11:00 AM'
        },
        {
          team1: { name: 'Brazil', flag: logoTeam1, score: 0 },
          vsTeam: Vsteam,
          team2: { name: 'Colombia', flag: logoTeam2, score: 0 },
          status: '',
          time: 'Tomorrow 11:00 AM'
        },
        {
          team1: { name: 'Brazil', flag: logoTeam1, score: 0 },
          vsTeam: Vsteam,
          team2: { name: 'Colombia', flag: logoTeam2, score: 0 },
          status: '',
          time: 'Tomorrow 11:00 AM'
        }
      ],
      matchesToShow: 4,
      showingMore: false
    };
  },
  computed: {
    displayedMatches() {
      return this.matches.slice(0, this.matchesToShow);
    },
    buttonText() {
      return this.showingMore ? 'Show less' : 'More matches →';
    }
  },
  methods: {
    toggleMatches() {
      if (this.showingMore) {
        this.matchesToShow = 4;
      } else {
        this.matchesToShow = this.matches.length;
      }
      this.showingMore = !this.showingMore;
    }
  }
};
</script>

<style scoped>
#matches {
  padding: 20px;
  margin-bottom: 15px;
  color: white;
  font-family: Arial, sans-serif;
}
h2 {
  text-align: center;
  font-size: 25px;
  margin-bottom: 20px;
}
.matches-grid {
  display: grid;
  grid-template-columns: repeat(2, 1fr); /* Adjust the number of columns as needed */
  gap: 20px;
}
.match {
  background-color: #2B2B2B;
  padding: 15px;
  border-radius: 8px;
  text-align: left;
  border: 1px solid #444;
  display: flex;
  flex-direction: column;
  justify-content: space-between;
}
.match-header {
  display: flex;
  justify-content: center;
  margin-bottom: 15px;
  font-size: 18px;
  color: #faf7f7;
}
.teams {
  display: flex;
  justify-content: space-between;
  align-items: flex-start;
}
.vsTeam {
  background: #fff;
  width: 50px;
  height: 50px;
  margin-right: 10px;
}
.team {
  display: flex;
  align-items: center;
  gap: 10px;
  margin-bottom: 15px;
}
.team img {
  width: 50px;
  height: 50px;
  margin-right: 10px;
  border: 1px solid #444;
  border-radius: 4px;
}
.status {
  text-align: center;
  margin-top: 10px;
  font-size: 14px;
  color: #BBB;
}
.more-matches {
  text-align: center;
  margin-top: 20px;
}
.more-matches button {
  padding: 10px 20px;
  background-color: #444;
  border: none;
  border-radius: 4px;
  color: white;
  cursor: pointer;
}
.more-matches button:hover {
  background-color: #555;
}
</style>

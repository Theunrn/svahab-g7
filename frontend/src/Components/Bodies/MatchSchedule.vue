<template>
  <div id="matches" class="bg-gray-400">
    <h2>Football Match Schedule</h2>
    <div class="matches-grid">
      <div class="match" v-for="(team, index) in displayedMatches" :key="index">
        <div class="match-header text-center">
          <div>{{ team.date_match }} - {{ team.start_time }} to {{ team.end_time }}</div>
        </div>
        <div class="teams">
          <div class="team">
            <img :src="getImageUrl(team.team_post_logo)" alt="Team 1 Flag" />
            <span>{{ team.team_post_name }}</span> | 
            <span>0</span>
          </div>
          <div class="team">
            <img src="../../assets/image/vs1.png" alt="vsTeam" class="vsTeam" />
          </div>
          <div class="team">
            <img :src="getImageUrl(team.team_logo)" alt="Team 2 Flag" />
            <span>{{ team.team_name }}</span> | 
            <span>0</span>
          </div>
        </div>
        <div class="status">
          <div class="match-time">{{ team.location }}</div>
        </div>
      </div>
    </div>
    <div class="more-matches">
      <button @click="toggleMatches">{{ buttonText }}</button>
    </div>
  </div>
</template>

<script>
import { ref, computed, onMounted } from 'vue'
import axiosInstance from '@/plugins/axios'

export default {
  setup() {
    const teams = ref([])
    const matchesToShow = ref(4)
    const showingMore = ref(false)

    const fetchMatches = async () => {
      try {
        const { data } = await axiosInstance.get('/match/list')
        teams.value = data.data
      } catch (error) {
        console.error('Error fetching matches:', error)
      }
    }

    const getImageUrl = (imagePath) => {
      return `http://127.0.0.1:8000/storage/${imagePath}`
    }

    const toggleMatches = () => {
      if (showingMore.value) {
        matchesToShow.value = 4
      } else {
        matchesToShow.value = teams.value.length
      }
      showingMore.value = !showingMore.value
    }

    const displayedMatches = computed(() => {
      return teams.value.slice(0, matchesToShow.value)
    })

    const buttonText = computed(() => {
      return showingMore.value ? 'Show less' : 'More matches →'
    })

    onMounted(() => {
      fetchMatches()
    })

    return { teams, getImageUrl, toggleMatches, displayedMatches, buttonText }
  }
}
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
  background-color: #5f5b5b;
  padding: 15px;
  border-radius: 8px;
  text-align: left;
  border: 1px solid #ece9e9;
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
  border: 1px solid #e6dcdc;
  border-radius: 4px;
}
.status {
  text-align: center;
  margin-top: 10px;
  font-size: 14px;
  color: #bbb;
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

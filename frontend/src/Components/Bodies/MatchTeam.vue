<template>
  <div class="container flex pt-3 font-sans flex items-center justify-center">
    <div class="picture-match w-300 mt-5 flex flex-col justify-center items-center">
      <div class="header text-center">
        <h1 class="text-5xl font-bold text-orange-500">We are finding</h1>
        <h2 class="text-3xl font-bold text-gray-700">match team for playing</h2>
      </div>
      <div class="text-center flex justify-center">
        <img src="../../assets/contact-piture/download-ball.png" alt="" class="w-80 h-80" />
      </div>
    </div>
    <div class="start">
      <button
        class="font-bold py-2 px-4 mt-2 rounded-lg w-40 border-2 border-gray-400 hover:bg-blue-700 hover:text-white"
        data-bs-toggle="modal"
        data-bs-target="#startModal"
      >
        Start
      </button>
    </div>
    <div id="carouselExampleInterval" class="carousel slide" data-bs-ride="carousel">
      <div class="carousel-inner">
        <div class="carousel-item active" data-bs-interval="10000">
          <div class="find-match flex flex-col items-center justify-center w-200">
            <div class="match-items grid grid-cols-1 gap-10">
              <div
                class="match-item text-center rounded-lg shadow-lg p-3 mb-3 w-150 hover:scale-105 transition-transform duration-300"
                v-if="latestPostTeam"
              >
                <div class="flex justify-center">
                  <div class="bg-blue w-30 rounded-2xl relative mb-2">
                    <p
                      class="match-time text-center p-1 text-sm text-white font-bold text-orange-500 relative z-10"
                    >
                    {{ formatTime(latestPostTeam.start_time) }} - {{ formatTime(latestPostTeam.end_time) }}
                    </p>
                  </div>
                </div>
                <div class="team-info flex justify-between items-center relative z-10">
                  <div class="relative z-40">
                    <img
                      :src="latestPostTeam && latestPostTeam.logo ? latestPostTeam.logo : ''"
                      alt="Team Logo"
                      class="w-30 h-30 object-cover rounded-full border-4 border-orange-500 overflow-hidden shadow-md hover:shadow-lg animate-sink"
                    />
                  </div>
                  <div class="team-logo flex items-center gap-2 p-2">
                    <p class="team-name text-sm font-bold text-gray-700 font-size-5">
                      {{ latestPostTeam.name }}
                    </p>
                  </div>
                  <div class="flex justify-center items-center">
                    <img
                      src="../../assets/image/vs1.png"
                      alt="VS"
                      class="vs w-19 h-19 mr-15 animate-pulse z-20"
                    />
                  </div>
                  <button
                    type="button"
                    data-bs-toggle="modal"
                    data-bs-target="#match"
                    class="match-btn mr-2 bg-orange-500 text-white rounded-md px-3 py-1 mt-2 mb-2 hover:bg-orange-600 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:ring-opacity-50 shadow-md hover:shadow-lg z-20"
                  >
                    Match Now
                  </button>
                </div>
                <div>
                  <div class="match-date text-base text-white flex justify-center">
                    <div class="w-50 bg-blue rounded-b-2xl relative">
                      <p class="text-sm font-bold p-1 relative z-10">
                        {{ latestPostTeam.start_match }} - {{ latestPostTeam.end_match }}
                      </p>
                    </div>
                  </div>
                </div>
                <div class="location">
                  <button
                    class="font-bold py-2 px-4 mt-2 rounded-lg w-40 border-2 border-gray-400 hover:bg-blue-700 hover:text-white"
                  >
                    Location
                  </button>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- Add more carousel items if needed -->
      </div>
      <button
        class="carousel-control-prev"
        type="button"
        data-bs-target="#carouselExampleInterval"
        data-bs-slide="prev"
      >
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
      </button>
      <button
        class="carousel-control-next"
        type="button"
        data-bs-target="#carouselExampleInterval"
        data-bs-slide="next"
      >
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
      </button>
    </div>
    <!-- Modal -->
    <div
      class="modal fade"
      id="match"
      tabindex="-1"
      aria-labelledby="exampleModalLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title text-2xl" id="exampleModalLabel">
              Please match your team for playing
            </h5>
            <button
              type="button"
              class="btn-close"
              data-bs-dismiss="modal"
              aria-label="Close"
            ></button>
          </div>
          <div class="modal-body">
            <form @submit.prevent="createMatch">
              <div class="mb-3" v-if="team_logo">
                <img :src="teamLogoUrl" width="100" height="100" alt="Team Logo" />
              </div>
              <div class="mb-3">
                <label for="teamLogoInput" class="form-label">Upload your team logo *</label>
                <input
                  type="file"
                  name="team_logo"
                  class="form-control"
                  id="teamLogoInput"
                  @change="handleFileUpload"
                />
              </div>
              <div class="mb-3">
                <label for="teamNameInput" class="form-label">Team Name *</label>
                <input type="text" class="form-control" v-model="team_name" id="teamNameInput" />
              </div>
              <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" id="agreementCheck" />
                <label class="form-check-label" for="agreementCheck"
                  >Do you agree with that time and match</label
                >
              </div>
              <div class="flex justify-end">
                <button type="submit" class="btn btn-primary">Match</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    <!-- Start Modal -->
    <div
      class="modal fade"
      id="startModal"
      tabindex="-1"
      aria-labelledby="startModalLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title text-2xl" id="startModalLabel">We are finding the team!</h5>
            <button
              type="button"
              class="btn-close"
              data-bs-dismiss="modal"
              aria-label="Close"
            ></button>
          </div>
          <div class="modal-body">
            <form @submit.prevent="postTeam">
              <div class="mb-3" v-if="team_logo">
                <img :src="teamLogoUrl" width="100" height="100" alt="Team Logo" />
              </div>
              <div class="mb-3">
                <label for="teamLogoInput" class="form-label">Upload your team logo *</label>
                <input
                  type="file"
                  name="team_logo"
                  class="form-control"
                  id="teamLogoInput"
                  @change="onFileChange"
                />
              </div>
              <div class="mb-3">
                <label for="teamNameInput" class="form-label">Team Name *</label>
                <input type="text" class="form-control" v-model="name" id="teamNameInput" />
              </div>
              <div class="mb-3">
                <label for="startMatchInput" class="form-label">Start Match *</label>
                <input
                  type="date"
                  class="form-control"
                  v-model="start_match"
                  id="startMatchInput"
                />
              </div>
              <div class="mb-3">
                <label for="endMatchInput" class="form-label">End Match *</label>
                <input
                  type="date"
                  class="form-control"
                  v-model="end_match"
                  id="endMatchInput"
                />
              </div>
              <div class="mb-3">
                <label for="startTimeInput" class="form-label">Start Time *</label>
                <input type="time" class="form-control" v-model="start_time" id="startTimeInput" />
              </div>
              <div class="mb-3">
                <label for="endTimeInput" class="form-label">End Time *</label>
                <input type="time" class="form-control" v-model="end_time" id="endTimeInput" />
              </div>
              <div class="mb-3">
                <label for="locationInput" class="form-label">Location *</label>
                <input type="text" class="form-control" v-model="location" id="locationInput" />
              </div>
              <div class="flex justify-end">
                <button type="submit" class="btn btn-primary">Post Team</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup lang="ts">
import { ref, computed, onMounted } from 'vue'
import axiosInstance from '@/plugins/axios'

const post_team_id = ref(1)
const team_name = ref('')
const team_logo = ref<File | null>(null)
const name = ref('')
const start_match = ref('')
const end_match = ref('')
const start_time = ref('')
const end_time = ref('')
const location = ref('')
const latestPostTeam = ref(null)


// Function to handle file upload
const handleFileUpload = (event: Event) => {
  const target = event.target as HTMLInputElement
  if (target.files && target.files[0]) {
    team_logo.value = target.files[0]
    console.log('File selected:', team_logo.value)
  }
}

const createMatch = async () => {
  try {
    const formData = new FormData()
    formData.append('team_post_id', post_team_id.value.toString()) // Corrected to 'team_post_id' based on your Laravel API
    formData.append('team_name', team_name.value)
    if (team_logo.value) {
      formData.append('team_logo', team_logo.value)
    }

    // Log formData entries for debugging
    formData.forEach((value, key) => {
      console.log(`${key}:`, value)
    })

    const response = await axiosInstance.post('/post/match', formData, {
      headers: {
        'Content-Type': 'multipart/form-data' // Ensure correct content type for file uploads
      }
    })

    console.log('Match created:', response.data)
    alert('Match created successfully')
    window.location.reload()
  } catch (error) {
    alert('Error creating match')
    console.error('Error creating match:', error.response ? error.response.data : error)
  }
}

// Function to handle file change
const onFileChange = (event: Event) => {
  const target = event.target as HTMLInputElement
  if (target.files && target.files[0]) {
    team_logo.value = target.files[0]
  }
}

const postTeam = async () => {
  try {
    const formData = new FormData()
    formData.append('name', name.value)
    formData.append('start_match', start_match.value)
    formData.append('end_match', end_match.value)
    formData.append('start_time', start_time.value)
    formData.append('end_time', end_time.value)
    formData.append('location', location.value)
    if (team_logo.value) {
      formData.append('logo', team_logo.value)
    }

    const response = await axiosInstance.post('/posts', formData, {
      headers: {
        'Content-Type': 'multipart/form-data'
      }
    })

    console.log('Team posted:', response.data)
    clearForm()
    await fetchLatestPostTeam() // Fetch the latest post team data
    window.location.reload()
  } catch (error) {
    alert('Error posting team')
    console.error('Error posting team:', error.response ? error.response.data : error)
  }
}

const clearForm = () => {
  name.value = ''
  start_match.value = ''
  end_match.value = ''
  start_time.value = ''
  end_time.value = ''
  location.value = ''
  team_logo.value = null
}

const teamLogoUrl = computed(() => {
  return team_logo.value ? URL.createObjectURL(team_logo.value) : ''
})

const fetchLatestPostTeam = async () => {
  try {
    const response = await axiosInstance.get('/latest-post-team') // Adjust the endpoint if needed
    latestPostTeam.value = response.data
    console.log('Latest post team data:', latestPostTeam.value)
  } catch (error) {
    console.error(
      'Error fetching latest post team data:',
      error.response ? error.response.data : error
    )
  }
}



onMounted(() => {
  fetchLatestPostTeam()
})


const formatTime = (time: string) => {
  // Assuming time is in 24-hour format 'HH:mm'
  const [hours, minutes] = time.split(':')
  let formattedTime = ''
  if (parseInt(hours) >= 12) {
    formattedTime = `${parseInt(hours) > 12 ? parseInt(hours) - 12 : 12}:${minutes} PM`
  } else {
    formattedTime = `${hours}:${minutes} AM`
  }
  return formattedTime
}
</script>

<style scoped>
.bg-blue {
  width: 150px; /* Adjust width as needed */
}
</style>

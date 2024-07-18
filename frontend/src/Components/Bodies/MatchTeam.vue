<template>
  <div class="container">
    <div class="header text-center flex justify-center mt-5" style="margin-bottom: -100px">
      <h1 class="text-3xl font-bold text-orange-500 border-b-1 border-gray-400 max-w-md">
        WE ARE FINDING MATCH TEAM
      </h1>
      <!-- <h2 class="text-2xl font-bold text-gray-700">MATCH TEAM</h2> -->
    </div>
    <div
      class="container flex font-sans flex items-center justify-center"
      style="min-height: 100vh"
    >
      <div class="picture-match w-300 mt-5 flex flex-col justify-center items-center mr-20">
        <div class="start ml-20">
          <h1 class="text-3xl font-bold text-orange-500">You can post</h1>
          <h2 class="text-2xl font-bold text-gray-700">to find your team for playing here!</h2>
          <button
            class="font-bold py-1 px-2 mt-2 rounded-lg w-30 hover:bg-orange-700 bg-orange-500 text-white hover:text-white"
            data-bs-toggle="modal"
            data-bs-target="#postModal"
          >
            Post Here
          </button>
        </div>
        <div class="text-center flex justify-center">
          <img src="../../assets/contact-piture/download-ball.png" alt="" class="w-60 h-60" />
        </div>
      </div>

      <div id="carouselExampleInterval" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
          <div
            v-for="(team, index) in allTeams"
            :key="index"
            class="carousel-item"
            :class="{ active: index === 0 }"
          >
            <div v-if="team" class="find-match flex flex-col items-center justify-center w-200">
              <div class="match-items grid grid-cols-1 gap-10">
                <div
                  class="match-item text-center rounded-lg shadow-lg p-3 mb-3 w-150 hover:scale-105 transition-transform duration-300"
                >
                  <div class="flex justify-center">
                    <div
                      class="bg-blue w-30 rounded-2xl relative mb-2"
                      v-if="team.start_time && team.end_time"
                    >
                      <p
                        class="match-time text-center p-1 text-sm text-white font-bold text-orange-500 relative z-10"
                      >
                        {{ formatTime(team.start_time) }} - {{ formatTime(team.end_time) }} Date:
                        {{ team.date_match }}
                      </p>
                    </div>
                  </div>
                  <div class="team-info flex justify-between items-center relative z-10">
                    <div class="relative z-40">
                      <img
                        :src="getImageUrl(team.logo)"
                        alt="Team Logo"
                        class="w-30 h-30 object-cover rounded-full border-4 border-orange-500 overflow-hidden shadow-md hover:shadow-lg animate-sink"
                      />
                      <div class="flex items-center ml-3 mt-3">
                        <!-- Edit Button -->
                        <button 
                          class="edit-post-btn text-gray-700 rounded-md px-3 py-1 mr-2 hover:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-400 focus:ring-opacity-50 shadow-md hover:shadow-lg z-20"
                          data-bs-toggle="modal"
                          data-bs-target="#editModal"
                          @click="editPost(team)"
                        >
                          <i class="bx bx-edit text-sm"></i>
                        </button>
                        <!-- Delete Button -->
                        <button
                          class="delete-post-btn text-gray-700 rounded-md px-3 py-1 mr-2 hover:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-400 focus:ring-opacity-50 shadow-md hover:shadow-lg z-20"
                          @click="deletePost(team.id)"
                        >
                          <i class="bx bx-trash text-sm"></i>
                        </button>
                      </div>
                    </div>
                    <div class="team-logo flex items-center gap-2 p-2">
                      <p class="team-name text-sm font-bold text-gray-700 font-size-5">
                        {{ team.name }}
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
                      @click="setPostId(team.id)"
                      class="match-btn mr-2 bg-orange-500 text-white rounded-md px-3 py-1 mt-2 mb-2 hover:bg-orange-600 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:ring-opacity-50 shadow-md hover:shadow-lg z-20"
                    >
                      Match Now
                    </button>
                  </div>
                  <div v-if="team.date_matchh">
                    <div class="match-date text-base text-white flex justify-center">
                      <div class="w-50 bg-blue rounded-b-2xl relative">
                        <p class="text-sm font-bold p-1 relative z-10">
                          {{ team.date_match }}
                        </p>
                      </div>
                    </div>
                  </div>
                  <div class="location">
                    <button
                      class="text-white bg-gradient-to-br from-purple-600 to-blue-500 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2"
                    >
                      {{ team.location }}
                    </button>
                  </div>
                </div>
              </div>
            </div>
          </div>
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
              <div class="mb-3" v-if="team_post_logo">
                <img :src="teamLogoUrl" width="100" height="100" alt="Team Logo" />
              </div>
              <div class="mb-3">
                <label for="teamLogoInput" class="form-label">Upload your team logo *</label>
                <input
                  type="file"
                  name="team_post_logo"
                  class="form-control"
                  id="teamLogoInput"
                  @change="handleFileUpload"
                />
              </div>
              <div class="mb-3">
                <label for="teamNameInput" class="form-label">Team Name *</label>
                <input type="text" class="form-control" v-model="team_name" id="teamNameInput" />
              </div>
              <!-- <input type="text" hidden class="form-control" value="" id="post_id" /> -->
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
    <!-- post Modal -->
    <div
      class="modal fade"
      id="postModal"
      tabindex="-1"
      aria-labelledby="postModalLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title text-2xl" id="startModalLabel">Post your team for playing!</h5>
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
                <label for="endMatchInput" class="form-label">Date Match *</label>
                <input type="date" class="form-control" v-model="date_match" id="endMatchInput" />
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
    <!-- Edit Team Modal -->
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="editModalLabel">Update your team post</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form @submit.prevent="updatePost">
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
              <div class="mb-3"></div>
              <div class="mb-3">
                <label for="teamNameInput" class="form-label">Team Name *</label>
                <input type="text" class="form-control" v-model="name" id="teamNameInput" />
              </div>
              <div class="mb-3">
                <label for="dateMatchInput" class="form-label">Date Match *</label>
                <input type="date" class="form-control" v-model="date_match" id="dateMatchInput" />
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
              <button type="submit" class="btn btn-primary">Update Post</button>
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

const post_team_id = ref('')
const post_id = ref('')
const team_name = ref('')
const team_logo = ref<File | null>(null)
const team_post_logo = ref<File | null>(null)
const name = ref('')
const date_match = ref('')
const start_time = ref('')
const end_time = ref('')
const location = ref('')
const allTeams = ref([])
const postId = ref(null);
// Function to handle file upload
const handleFileUpload = (event: Event) => {
  const target = event.target as HTMLInputElement
  if (target.files && target.files[0]) {
    team_post_logo.value = target.files[0]
  }
}

const createMatch = async () => {
  try {
    const formData = new FormData()
    formData.append('team_post_id', post_id.value) // Corrected to 'team_post_id' based on your Laravel API
    formData.append('team_name', team_name.value)
    if (team_post_logo.value) {
      formData.append('team_logo', team_post_logo.value)
    }

    const response = await axiosInstance.post('/post/match', formData, {
      headers: {
        'Content-Type': 'multipart/form-data' // Ensure correct content type for file uploads
      }
    })
    alert('Match created successfully')
    window.location.reload()
  } catch (error) {
    alert('Error creating match')
    console.error('Error creating match:', error.response ? error.response.data : error)
  }
}

const isUsersPost = (team) => {
  // Implement your logic here to check if the current user is the owner of the post
  // For example, compare user ID or username with the post's creator ID or username
  // Assuming you have a way to get the current user's ID or username
  // Replace this with your actual logic based on your authentication and user management setup
  const currentUser = getCurrentUser() // Replace with your actual implementation
  return team.user_id === currentUser.id // Adjust this based on your user and post data structure
}

const getCurrentUser = () => {
  return {
    id: 'user123', // Example user ID
    username: 'exampleUser', // Example username
    // Add other relevant user details if needed
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
    formData.append('date_match', date_match.value)
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

    console.log('Team posted:', response.data.data)
    clearForm()
    await fetchAllTeams() // Fetch the latest post team data
    window.location.reload()
  } catch (error) {
    alert('Error posting team')
    console.error('Error posting team:', error.response ? error.response.data : error)
  }
}

const clearForm = () => {
  name.value = ''
  date_match.value = ''
  start_time.value = ''
  end_time.value = ''
  location.value = ''
  team_logo.value = null
}

const updatePost = async () => {
  try {
    const formData = new FormData()
    formData.append('name', name.value)
    formData.append('date_match', date_match.value)
    formData.append('start_time', start_time.value)
    formData.append('end_time', end_time.value)
    formData.append('location', location.value)
    if (team_logo.value) {
      formData.append('logo', team_logo.value)
    }

    const response = await axiosInstance.put(`/post/update/${post_id.value}`, formData, {
      headers: {
        'Content-Type': 'multipart/form-data'
      }
    })

    console.log(response.data) // Log the response for debugging
    // Handle success (e.g., update the team in the list, show success message, etc.)
  } catch (error) {
    console.error(error) // Log the error for debugging
    // Handle error (e.g., show error message, etc.)
  }
}

const editPost = (team) => {
  name.value = team.name
  date_match.value = team.date_match
  start_time.value = team.start_time
  end_time.value = team.end_time
  location.value = team.location
  // If the team logo is a URL, you'll need to handle how to display it or how to re-upload it
  // You may need to adjust this part based on how the team logo is managed
  team_logo.value = team.logo // Set to null to avoid pre-filling the file input with any value
  post_id.value = team.id // Assuming `post_id` is the identifier for the post
}



// Method to delete a post
const deletePost = async (postId) => {
  try {
    // Make an API call to delete the post by postId
    const response = await axiosInstance.delete(`/posts/${postId}`);


    // Optionally, handle success message or update UI
    alert('Post deleted successfully');
    // Example: Refresh the list of teams after deletion (assuming `fetchAllTeams` is a method to update your data)
    await fetchAllTeams();
  } catch (error) {
    // Handle error responses
    alert('Error deleting post');
    console.error('Error deleting post:', error.response ? error.response.data : error);
  }
};

const teamLogoUrl = (logoPath: string) => {
  return logoPath ? `/storage/${logoPath}` : '' // Adjust according to your storage path
}

const fetchAllTeams = async () => {
  try {
    const response = await axiosInstance.get('/post/list') // Adjust endpoint based on your API
    allTeams.value = response.data.data
  } catch (error) {
    console.error('Error fetching all teams:', error.response ? error.response.data : error)
  }
}
const getImageUrl = (imagePath) => {
  return (imagePath = `http://127.0.0.1:8000/storage/${imagePath}`)
}
const setPostId = (id) => {
  postId.value = id;
  
};
onMounted(() => {
  fetchAllTeams()
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

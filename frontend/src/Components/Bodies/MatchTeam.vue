<template>
  <div class="container">
    <div class="header text-center flex justify-center mt-5" style="margin-bottom: -100px">
      <h1 class="text-3xl font-bold text-orange-500 border-b-1 border-gray-400 max-w-md">
        WE ARE FINDING MATCH TEAM
      </h1>
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
          <div v-if="allTeams.length > 0">
            <div
              v-for="(team, index) in allTeams"
              :key="team.id"
              class="carousel-item"
              :class="{ active: index === 0 }"
            >
              <div
                v-if="team.id"
                class="find-match flex flex-col items-center justify-center w-200"
              >
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
                        <div v-if="team.user_id == posterId" class="flex items-center ml-3 mt-3">
                          <!-- Edit Button -->
                          <button
                            class="edit-post-btn text-gray-700 rounded-md px-3 py-1 mr-2 hover:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-400 focus:ring-opacity-50 shadow-md hover:shadow-lg z-20"
                            data-bs-toggle="modal"
                            data-bs-target="#editModal"
                            @click="editPost(team)"
                          >
                            <i class="bx bx-edit text-sm text-blue-500"></i>
                          </button>
                          <!-- Delete Button -->
                          <button
                            class="delete-post-btn text-gray-700 rounded-md px-3 py-1 mr-2 hover:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-400 focus:ring-opacity-50 shadow-md hover:shadow-lg z-20"
                            @click="confirmDelete(team.id)"
                          >
                            <i class="bx bx-trash text-sm text-red-500"></i>
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
          <div v-else class="find-match flex flex-col items-center justify-center w-200">
            <img width="400" height="400" src="../../assets/image/404.png" alt="" />
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
    <div
      class="modal fade"
      id="editModal"
      tabindex="-1"
      aria-labelledby="editModalLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="editModalLabel">Update your team post</h5>
            <button
              type="button"
              class="btn-close"
              data-bs-dismiss="modal"
              aria-label="Close"
            ></button>
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
  // ======================= import nuccesary files and libraries =======================
  import { ref, computed, onMounted } from 'vue'
  import { useRoute, useRouter } from 'vue-router'
  import axiosInstance from '@/plugins/axios'
  import Swal from 'sweetalert2'
  import 'bootstrap/dist/css/bootstrap.min.css'
  import 'bootstrap/dist/js/bootstrap.bundle.min.js'

  //=========== All variables =================
  const router = useRouter()
  const post_team_id = ref('')
  const route = useRoute()
  const userId = computed(() => route.query.customer)
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
  const status = ref(false)
  const postId = ref(null)
  const deleteItemId = ref(null)
  const props = defineProps({ customer: Object })
  const posterId = ref(props.customer.id)
  const now = () => formatDate(new Date())

  //=========== set date formatting ============
  const formatDate = (date) => {
    const year = date.getFullYear()
    const month = String(date.getMonth() + 1).padStart(2, '0')
    const day = String(date.getDate()).padStart(2, '0')
    return `${year}-${month}-${day}`
  }

  // ============ Function to handle file upload =============
  const handleFileUpload = (event: Event) => {
    const target = event.target as HTMLInputElement
    if (target.files && target.files[0]) {
      team_post_logo.value = target.files[0]
    }
  }

  //============== match team for playyings =============
  const createMatch = async () => {
    try {
      const formData = new FormData()
      formData.append('team_post_id', post_id.value)
      formData.append('team_name', team_name.value)
      if (team_post_logo.value) {
        formData.append('team_logo', team_post_logo.value)
      }
    
      await axiosInstance.post('/post/match', formData, {
        headers: {
          'Content-Type': 'multipart/form-data'
        }
      })

      await axiosInstance.put(`/post/update/${post_id.value}`)
      Swal.fire({
        position: 'center',
        icon: 'success',
        html: `<span style="font-size: 26px; font-weight: bold;">Matched successfully</span>`,
        showConfirmButton: false,
        timer: 1000
      }).then(() => {
        window.location.reload()
      })
    } catch (error) {
      alert('Error creating match')
      console.error('Error creating match:', error.response ? error.response.data : error)
    }
  }

  // ======================== Function to handle file change ===================
  const onFileChange = (event: Event) => {
    const target = event.target as HTMLInputElement
    if (target.files && target.files[0]) {
      team_logo.value = target.files[0]
    }
  }

  // ======================== Function to create post =========================
  const postTeam = async () => {
    try {
      const formData = new FormData()
      formData.append('name', name.value)
      formData.append('date_match', date_match.value)
      formData.append('start_time', start_time.value)
      formData.append('end_time', end_time.value)
      formData.append('location', location.value)
      formData.append('post_date', now())
      if (team_logo.value) {
        formData.append('logo', team_logo.value)
      }
      
      const response = await axiosInstance.post('/posts', formData, {
        headers: {
          'Content-Type': 'multipart/form-data'
        }
      })
      Swal.fire({
        position: 'center',
        icon: 'success',
        html: `<span style="font-size: 26px; font-weight: bold;">You posted successfully</span>`,
        showConfirmButton: false,
        timer: 1000
      }).then(() => {
        window.location.reload()
      })
    } catch (error) {
      alert('Error posting team')
      console.error('Error posting team:', error.response ? error.response.data : error)
    }
  }

  // ======================== Function to update post status=========================
  const updatePost = async () => {
    if (!postId.value) {
      alert('No post ID available for update')
      return
    }
    try {
      const requestBody = {
        name: name.value,
        date_match: formatDate(new Date(date_match.value)),
        start_time: start_time.value,
        end_time: end_time.value,
        post_date: formatDate(new Date()),
        location: location.value,
        // logo: team_logo.value ? team_logo.value.name : null,
        user_id: posterId.value,
      }
      console.log(requestBody)
      const response = await axiosInstance.put(`/post/modify/${postId.value}`, requestBody, {
        headers: {
          'Content-Type': 'application/json'
        }
      })

      Swal.fire({
        position: 'center',
        icon: 'success',
        html: `<span style="font-size: 26px; font-weight: bold;">You updated poste successfully</span>`,
        showConfirmButton: false,
        timer: 1000
      }).then(() => {
        window.location.reload()
      })
    } catch (error) {
      Swal.fire({
        title: 'Error',
        text: 'Edit your post is failed. Please try again',
        icon: 'error',
        confirmButtonText: 'OK'
      })
      console.error('Error:', error)
    }
  }
  // ======================== Function to show post specifict for edit =========================
  const editPost = (team: any) => {
    postId.value = team.id
    name.value = team.name
    date_match.value = team.date_match
    start_time.value = team.start_time
    end_time.value = team.end_time
    location.value = team.location
    team_logo.value = getImageUrl(team.logo)
  }

  // ====================get logo url api =================
  const teamLogoUrl = (logoPath: string) => {
    return logoPath ? `/storage/${logoPath}` : ''
  }

  //================ get all team posted ====================
  const fetchAllTeams = async () => {
    try {
      const response = await axiosInstance.get('/post/list')
      allTeams.value = response.data.data
    } catch (error) {
      console.error('Error fetching all teams:', error.response ? error.response.data : error)
    }
  }

  // ====================get image url api =================
  const getImageUrl = (imagePath) => {
    return (imagePath = `http://127.0.0.1:8000/storage/${imagePath}`)
  }
  // ============= get post id =================
  const setPostId = (postId) => {
    post_id.value = postId
  }
  onMounted(() => {
    fetchAllTeams()
  })

  // ================= Assuming time is in 24-hour format 'HH:mm' =================
  const formatTime = (time: string) => {
    const [hours, minutes] = time.split(':')
    let formattedTime = ''
    if (parseInt(hours) >= 12) {
      formattedTime = `${parseInt(hours) > 12 ? parseInt(hours) - 12 : 12}:${minutes} PM`
    } else {
      formattedTime = `${hours}:${minutes} AM`
    }
    return formattedTime
  }

  //================ fuction for closte mondal =================
  const closeModal = (modalId) => {
    const modalElement = document.getElementById(modalId)
    modalElement.classList.remove('show')
    modalElement.style.display = 'none'
    document.body.classList.remove('modal-open')
    const backdrop = document.querySelector('.modal-backdrop')
    if (backdrop) {
      backdrop.parentNode.removeChild(backdrop)
    }
  }

  // ============= function for delete post =================
  const confirmDelete = async (id) => {
    deleteItemId.value = id
    console.log(deleteItemId.value)
    const swalWithBootstrapButtons = Swal.mixin({
      customClass: {
        confirmButton: 'btn btn-success',
        cancelButton: 'btn btn-danger me-2'
      },
      buttonsStyling: false
    })

    swalWithBootstrapButtons
      .fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Yes, delete it!',
        cancelButtonText: 'No, cancel!',
        reverseButtons: true
      })
      .then(async (result) => {
        if (result.isConfirmed) {
          try {
            await axiosInstance.delete(`/posts/${deleteItemId.value}`)
            swalWithBootstrapButtons.fire({
              title: 'Deleted!',
              text: 'Your file has been deleted.',
              icon: 'success',
              timer: 1000,
              showConfirmButton: false
            })
            closeModal('deleteModal')
          } catch (error) {
            console.error('Error deleting item:', error)
            swalWithBootstrapButtons.fire({
              title: 'Error',
              text: 'There was an error deleting the item.',
              icon: 'error',
              timer: 1000,
              showConfirmButton: false
            })
          }
        }
      })
  }
</script>

<style scoped>
  .bg-blue {
    width: 150px;
  }
</style>

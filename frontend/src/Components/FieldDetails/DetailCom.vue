<template>
  <WebHeaderMenu />
  <div class="header-text mt-5">
    <div class="header-detail">
      <div
        class="select absolute mt-17 bg-green bg-opacity-900 z-20 rounded-lg w-full md:w-5/5 lg:w-9/10 ml-16 flex justify-center items-center"
      >
        <router-link
          :to="{ path: '/field/detail/' + fieldId, query: { customer: userId } }"
          class="menu-item bg-white text-dark border-t-4 border-orange-500"
        >
          <i class="bx bx-home text-2xl"></i>
          <span>Fields</span>
        </router-link>
        <router-link
          :to="{ path: '/scheduleField', query: { field: fieldId, user: userId } }"
          class="menu-item"
        >
          <i class="bx bx-calendar text-2xl"></i>
          <span>Schedule</span>
        </router-link>
        <router-link
          :to="{ path: '/lineUp', query: { field: fieldId, user: userId } }"
          class="menu-item"
        >
          <i class="bx bx-line-chart text-2xl"></i>
          <span>Line Up</span>
        </router-link>
      </div>
    </div>
    <div class="mt-5 flex gap-5 ml-13 container">
      <div class="map-left w-80">
        <!-- w-96 sets a fixed width for the left div -->
        <div class="card-me">
          <div class="card-wrapper relative w-full mx-2 my-2 border-1 border-gray-400 rounded-md">
            <div class="container bg-overlay">
              <div class="flex">
                <div class="row text-center flex flex-col items-center justify-center h-full">
                  <button
                    type="button"
                    data-bs-toggle="modal"
                    data-bs-target="#mapModal"
                    class="btn flex gap-1 btn-primary btn-details py-2 me-2"
                  >
                    <i class="bx bxs-map tex-3xl mt-1"></i>
                    <p>Show on map</p>
                  </button>
                </div>
              </div>
            </div>
            <div class="w-100">
              <button
                class="bg-yellow-400 w-full p-2 text-dark text-bold rounded-l"
                style="font-weight: bold"
              >
                ${{ field.price }}.00/Hour
              </button>
            </div>
          </div>
        </div>

        <div class="user-detail">
          <h2 class="text-center">BOOKING FORM</h2>
          <hr />
          <form @submit.prevent="submitBooking">
            <div class="form-group half-width">
              <label for="date">Date *</label>
              <input type="date" id="date" @change="bookingDate" v-model="booking_date" />
            </div>
            <div class="form-group half-width">
              <label for="start">Start time *</label>
              <input type="time" id="start" @change="start" v-model="start_time" />
            </div>
            <div class="clearfix"></div>
            <div class="form-group">
              <label for="end">End time *</label>
              <input type="time" id="end" @change="end" v-model="end_time" />
            </div>
            <!-- <div class="form-group">
              <label for="duration">Your duration (hour) *</label>
              <input type="text" id="duration" v-model="duration" disabled />
            </div> -->
            <div class="form-group">
              <label for="number-of-guests">Total Price ($) *</label>
              <input disabled type="number" id="number-of-guests" v-model="total_price" />
            </div>
            <div class="wrapper-card relative w-full mx-2 my-2 rounded-md">
              <h2>Your Option (optional)</h2>
              <div class="flex items-center">
                <input
                  id="vue-checkbox"
                  type="checkbox"
                  value=""
                  class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500"
                />
                <label
                  for="vue-checkbox"
                  class="w-full py-2 ms-2 text-sm font-medium text-gray-900 dark:text-gray-300"
                  >Water</label
                >
              </div>
              <div class="flex items-center">
                <input
                  id="react-checkbox"
                  type="checkbox"
                  value=""
                  class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500"
                />
                <label
                  for="react-checkbox"
                  class="w-full py-2 ms-2 text-sm font-medium text-gray-900 dark:text-gray-300"
                  >Live</label
                >
              </div>
              <div class="flex items-center">
                <input
                  id="angular-checkbox"
                  type="checkbox"
                  value=""
                  class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500"
                />
                <label
                  for="angular-checkbox"
                  class="w-full py-2 ms-2 text-sm font-medium text-gray-900 dark:text-gray-300"
                  >Take Photo</label
                >
              </div>
            </div>
            <button
              type="submit"
              class="btn-book match-btn mr-2 bg-orange-500 w-40 text-white rounded-md px-3 py-1 mt-2 mb-2 hover:bg-orange-600 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:ring-opacity-50 shadow-md hover:shadow-lg z-20"
            >
              Payment
            </button>
          </form>
        </div>
      </div>

      <div class="map-right w-244">
        <!-- w-96 sets a fixed width for the right div -->
        <div class="w-full w-214">
          <!-- <h2 class="text-2xl font-bold">7Seasons Apartments offers</h2> -->
          <img :src="getImageUrl(field.image)" alt="" class="w-full h-74 object-cover" />
        </div>
        <div class="gap-2 overflow-y-auto h-50">
          <div class="card-text mt-4">
            <div class="card-display-container gap-3 flex flex-col">
              <router-link
                :to="{ path: '/field/detail/' + field.id, query: { customer: userId } }"
                class="card-display border border-gray-400 rounded-lg shadow-lg flex overflow-hidden"
                v-for="field in fields"
                :key="field"
              >
                <div class="relative w-1/3 p-2">
                  <img
                    :src="getImageUrl(field.image)"
                    alt=""
                    class="w-full h-55 object-cover rounded-md"
                    style="border-radius: 10px"
                  />
                  <span
                    class="absolute top-5 right-5 bg-gray-200 rounded-full p-1 shadow-md cursor-pointer"
                  >
                    <img src="../../assets/image/heart.png" alt="Heart icon" class="w-8 h-8 p-1" />
                  </span>
                </div>
                <div class="flex flex-col justify-between p-4 w-2/3">
                  <div class="mb-2">
                    <h3 class="text-xl font-bold text-gray-900 mb-2">
                      <strong class="text-orange font-bold">{{ field.name }}</strong>
                    </h3>
                    <a href="#" class="flex gap-2">
                      <i class="bx bx-map text-3xl text-red-400"></i>
                      <p class="text-gray-700">{{ field.location }}</p>
                    </a>
                  </div>
                  <div class="text-gray-700">
                    <p class="mt-2 cursor-pointer">
                      <span class="price bg-blue-500 text-white p-2 rounded-md mr-2"
                        >${{ field.price }}.00</span
                      >
                    </p>
                    <div class="rating mt-3">
                      <span class="star">&#9733;</span>
                      <span class="star">&#9733;</span>
                      <span class="star">&#9733;</span>
                      <span class="star">&#9733;</span>
                      <span class="star">&#9734;</span>
                    </div>
                    <span class="viewer">2,965 reviews</span>
                  </div>
                </div>
              </router-link>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="contaner">
      <div class="head"><h1>Post a Comment feedback</h1></div>
      <div>
        <span id="comment">{{ Feedbacklist.length }}</span> Comment
      </div>
      <div class="text"><p>We are happy to hear from your feedback</p></div>
      <div class="comment">
        <div v-for="feedback in Feedbacklist" :key="feedback.id" class="comment-item">
          <img src="../../assets/image/liep.jpg" alt="Commenter's avatar" />
          <div class="comment-content">
            <h3><strong>{{ feedback.user.toUpperCase() }} </strong> <span class="text-sm"> - {{ feedback.created_at }}</span></h3>
            <p>{{ feedback.feedback_text }}</p>
          </div>
          <div class="relative flex">
            <button @click="toggleDropdown(feedback)" class="text-gray-400 hover:text-gray-700">
              <svg
                class="w-5 h-5"
                aria-hidden="true"
                xmlns="http://www.w3.org/2000/svg"
                fill="currentColor"
                viewBox="0 0 4 15"
              >
                <path
                  d="M3.5 1.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Zm0 6.041a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Zm0 5.959a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Z"
                />
              </svg>
            </button>
            <ul 
              v-if="feedback.showDropdown"
              class="absolute right-0 mt-4 w-30 bg-white border rounded-lg shadow-xl flex flex-col"
            >
              
              <li v-if="feedback.user_id == userId">
                <a
                  @click="deleteItem(feedback.id)"
                  class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white"
                  >Delete <div class="pos-demo"></div>
                  </a
                >
              </li>
              <li v-if="feedback.user_id == userId">
                <a
                  @click="showEditModal(feedback)"
                  class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white"
                  >Edit <div class="pos-demo"></div>
                  </a 
                >
              </li>
              <li v-else>
                <span 
                  class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white"
                  ><i class='bx bxs-comment-error'></i></span
                >
              </li>
            </ul>
          </div>
        </div>
      </div>
      <div class="commentbox">
        <img src="../../assets/image/liep.jpg" alt="User avatar" />
        <div class="content">
          <h2>Comment as:</h2>
          <!-- <input type="text" v-model="currentUser" class="user" /> -->
          <div class="commentinput">
            <input
              type="text"
              placeholder="Enter comment"
              v-model="feedback_text"
              class="usercomment"
            />
            <div class="pos-demo"></div>
            <div class="buttons">
              
              <button @click="SubmitFeedback" :disabled="!feedback_text" id="publish">
                Submit 
              </button>
              
            </div>
          </div>
        </div>
      </div>

      <!-- Edit Feedback Modal -->
      <div
        v-if="editFeedbackModalVisible"
        class="fixed inset-0 flex items-center justify-center bg-gray-500 bg-opacity-75"
      >
        <div class="bg-white p-6 rounded-lg w-96">
          <h3 class="text-lg font-semibold mb-4 text-black">Edit Feedback</h3>
          <textarea
            v-model="editedFeedbackText"
            class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm text-black"
            rows="4"
          ></textarea>
          <div class="mt-4 flex justify-end">
            <button
              @click="updateFeedback()"
              class="px-4 py-2 bg-blue-500 text-white font-semibold rounded-md shadow hover:bg-blue-600"
            >
              Update
            </button>
            <button
              @click="closeEditModal()"
              class="px-4 py-2 bg-gray-300 text-gray-800 font-semibold rounded-md shadow ml-2 hover:bg-gray-400"
            >
              Cancel
            </button>
          </div>
        </div>
      </div>
    </div>
    <div
      class="modal fade"
      id="mapModal"
      tabindex="-1"
      aria-labelledby="exampleModalLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog modal-xl">
        <div class="modal-content">
          <div class="modal-body">
            <div
              class="absolute right-5 bg-gray-200 rounded-full p-2 shadow-md cursor-pointer"
              style="top: -17px; right: -17px"
            >
              <button
                type="button"
                class="btn-close text-bold text-2xl bg-gray-200"
                data-bs-dismiss="modal"
                aria-label="Close"
              ></button>
            </div>
            <div class="flex gap-3">
              <!-- Set height to 50% of the viewport height -->
              <!-- Cards Container -->
              <div class="flex flex-col w-1/2">
                <h1 class="mb-2 text-3xl text-red-400">List Fields</h1>
                <router-link
                  :to="{ path: '/field/detail/' + field.id, query: { customer: userId } }"
                  class="card-display border border-gray-400 rounded-lg shadow-md flex overflow-hidden mb-1"
                  v-for="field in fields"
                  :key="field.id"
                  style="width: 100%"
                >
                  <div class="relative w-full p-2">
                    <img
                      :src="getImageUrl(field.image)"
                      alt=""
                      class="w-full h-40 object-cover rounded-md"
                      style="border-radius: 10px"
                    />
                    <span
                      class="absolute top-5 right-5 bg-gray-200 rounded-full p-1 shadow-md cursor-pointer"
                    >
                      <img
                        src="../../assets/image/heart.png"
                        alt="Heart icon"
                        class="w-8 h-8 p-1"
                      />
                    </span>
                  </div>
                  <div class="flex flex-col fap-2 p-4 w-full">
                    <div class="mb-2">
                      <h3 class="text-xl font-bold text-gray-900 mb-2 flex gap-2">
                        <strong class="text-orange font-bold">{{ field.name }}</strong>
                        <div class="star">
                          <i class="bx bxs-star text-yellow-400"></i>
                          <i class="bx bxs-star text-yellow-400"></i>
                          <i class="bx bxs-star text-yellow-400"></i>
                          <i class="bx bx-star text-yellow-400"></i>
                        </div>
                      </h3>
                      <a href="#" class="flex gap-2">
                        <i class="bx bx-map text-3xl text-red-400"></i>
                        <p class="text-gray-700">{{ field.location }}</p>
                      </a>
                    </div>
                    <div class="text-gray-700 flex">
                      <p class="mt-2 cursor-pointer">
                        <span class="price bg-blue-500 text-white p-2 rounded-md mr-2"
                          >${{ field.price }}.00</span
                        >
                      </p>
                      <span class="viewer mt-1">2,965 reviews</span>
                    </div>
                  </div>
                </router-link>
              </div>
              <!-- Map Container -->
              <div class="map w-1/2 pt-5 pr-1">
                <!-- Ensure this div takes 50% width -->
                <MapCom :address="receivedAddress" :location="location" />
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <CurrentUser hidden @location-updated="updateLocation" @address-updated="updateAddress" />
</template>

<script setup lang="ts">
import WebHeaderMenu from '@/Components/WebHeaderMenu.vue'
import MapCom from '@/Components/Maps/MapCom.vue'
import CurrentUser from '@/Components/Maps/CurrentUser.vue'
import { ref, computed, watch, onMounted } from 'vue'
import VueFlatpickr from 'vue-flatpickr-component'
import 'flatpickr/dist/flatpickr.css'
import { useRoute, useRouter } from 'vue-router'
import axiosInstance from '@/plugins/axios'
import { ElMessage, ElMessageBox } from 'element-plus'
import type { Action } from 'element-plus'
import dayjs from 'dayjs'
import relativeTime from 'dayjs/plugin/relativeTime'
import Swal from 'sweetalert2'

// Load the relativeTime plugin
dayjs.extend(relativeTime)

const route = useRoute()
const router = useRouter()
const userId = computed(() => route.query.customer)
const fieldId = computed(() => route.params.id)
const start_time = ref('')
const end_time = ref('')
const total_price = ref('00.00')
const booking_date = ref<Date | null>(null)
const bookings = ref<any[]>([])
const field = ref({})
const price = ref(0)
const booking = ref({})
const duration = ref(0)
const isBook = ref(false)
const fields = ref([])
const location = ref('')
const feedback_text = ref('')
const Feedbacklist = ref([])
const isclear = ref(false)
const receivedAddress = ref<string>('')

// Event handler for address-updated event
const updateAddress = (updatedAddress: string) => {
  receivedAddress.value = updatedAddress
}

// Event handler for location-updated event
const updateLocation = (updatedLocation: string) => {
  location.value = updatedLocation
}

const calculateTotalPrice = () => {
  const startTimeParts = start_time.value.split(':').map(Number)
  const endTimeParts = end_time.value.split(':').map(Number)

  const startMinutes = startTimeParts[0] * 60 + startTimeParts[1]
  const endMinutes = endTimeParts[0] * 60 + endTimeParts[1]

  const durationInMinutes = endMinutes - startMinutes
  const pricePerMinute = price.value / 60

  total_price.value = (durationInMinutes * pricePerMinute).toFixed(2)
  duration.value = durationInMinutes / 60
}

const submitBooking = async () => {
  try {
    const response = await axiosInstance.post('/booking/create', {
      user_id: userId.value,
      field_id: fieldId.value,
      start_time: start_time.value,
      end_time: end_time.value,
      booking_date: booking_date.value,
      total_price: total_price.value,
      status: 'pending',
      payment_status: 'unpaid'
    })

    bookings.value.push(response.data)
    booking.value = response.data.data

    // Create event
    try {
      const startDateTime = `${booking_date.value} ${start_time.value}:00`
      const endDateTime = `${booking_date.value} ${end_time.value}:00`
      const eventResponse = await axiosInstance.post('/event/create', {
        field_id: fieldId.value,
        title: `Booking for ${field.value.name}`,
        start: startDateTime,
        end: endDateTime
      })

      console.log('Event created:', eventResponse.data)
    } catch (error) {
      console.error('Error creating event:', error)
    }

    Swal.fire({
      position: 'center',
      icon: 'success',
      html: `<span style="font-size: 26px; font-weight: bold;">Thank you for your booking! We will send you a notification soon</span>`,
      showConfirmButton: false,
      timer: 1000
    }).then(() => {
      router.push({
        path: `/payment/${userId.value}`,
        query: { booking: booking.value.id }
      })
    })
  } catch (error) {
    // Show error message
    Swal.fire({
      title: 'Error',
      text: 'Your booking is failed. Please try again',
      icon: 'error',
      confirmButtonText: 'OK'
    })
    console.error('Error creating booking:', error)
  }
}


const fetchField = async () => {
  try {
    const response = await axiosInstance.get(`/field/show/${fieldId.value}`)
    field.value = response.data.data
    price.value = field.value.price
    location.value = field.value.location
  } catch (error) {
    console.error('Error fetching fields:', error)
  }
}

const fetchFields = async () => {
  try {
    const response = await axiosInstance.get('/fields/list')
    fields.value = response.data.data
  } catch (error) {
    console.error('Error fetching fields:', error)
  }
}

const SubmitFeedback = async () => {
  try {
    const response = await axiosInstance.post('/feedback/create', {
      user_id: userId.value,
      field_id: fieldId.value,
      feedback_text: feedback_text.value
    })
    $(".pos-demo").notify("Create feedback successful", "success", { position: "top" });
    isclear.value = true
    fetchFeedbackList()
    clearFeedbackData()
  } catch (error) {
    $(".pos-demo").notify("Create feedback fail", "danger", { position: "top" });
    console.error('Error creating booking:', error)
  }
}

const fetchFeedbackList = async () => {
  try {
    const response = await axiosInstance.get(`/feedbacks/${fieldId.value}`, {
      headers: {
        Authorization: `Bearer ${localStorage.getItem('access_token')}`
      }
    })
    Feedbacklist.value = response.data.data
  } catch (error) {
    console.error('Error fetching feedbacks:', error)
  }
}

const toggleDropdown = (feedback) => {
  feedback.showDropdown = !feedback.showDropdown
}

const deleteItem = async (itemId) => {
  try {
    await axiosInstance.delete(`/feedback/delete/${itemId}`, {
      headers: {
        Authorization: `Bearer ${localStorage.getItem('access_token')}`
      }
    })
    Feedbacklist.value = Feedbacklist.value.filter((item) => item.id !== itemId)
    $(".pos-demo").notify("Feedback remove successful", "success", { position: "top" });
  } catch (error) {
    console.error('Error deleting item:', error)
    $(".pos-demo").notify("Failed remove feedback", "danger", { position: "top" });

  }
}

const editFeedbackModalVisible = ref(false)
const editedFeedbackText = ref('')
let feedbackToEdit = ref(null)

const showEditModal = (feedback) => {
  feedbackToEdit.value = feedback
  editedFeedbackText.value = feedback.feedback_text
  editFeedbackModalVisible.value = true
}

const closeEditModal = () => {
  editFeedbackModalVisible.value = false
}

const updateFeedback = async () => {
  try {
    const response = await axiosInstance.put(`/feedback/update/${feedbackToEdit.value.id}`, {
      feedback_text: editedFeedbackText.value
    })
    const updatedFeedbackIndex = Feedbacklist.value.findIndex(
      (item) => item.id === feedbackToEdit.value.id
    )
    if (updatedFeedbackIndex !== -1) {
      Feedbacklist.value[updatedFeedbackIndex].feedback_text = editedFeedbackText.value
    }
    closeEditModal()
    $(".pos-demo").notify("Feedback updated successfully!", "success", { position: "top" });

  } catch (error) {
    $(".pos-demo").notify("Failed to update feedback.", "success", { position: "top" });
    console.error('Error updating feedback:', error)
  }
}

const clearFeedbackData = () => {
  feedback_text.value = ''
}

onMounted(() => {
  fetchField()
  fetchFields()
  fetchFeedbackList()
  if (isclear.value) {
    clearFeedbackData()
  }
})

const getImageUrl = (imagePath) => {
  return imagePath ? `http://127.0.0.1:8000/storage/${imagePath}` : '/default-image.jpg'
}

watch([start_time, end_time], calculateTotalPrice)
</script>


<style scoped>
/* Additional styling if needed */

.header-text {
  color: #000;
}
.header-detail {
  height: 100px;
  background-color: rgb(144, 124, 91);
}

.notifyjs-corner {
  z-index: 10000 !important;
}

h2 {
  margin-top: 10px;
  margin-bottom: 10px;
  font-size: 20px;
  font-weight: bold;
}
h5 {
  font-size: 15px;
  font-weight: bold;
  text-align: center;
}

.rating .star {
  color: #ffcc00;
  font-size: 20px;
}
.viewer {
  font-size: 15px;
  text-align: center;
  color: #808080;
}
.card-wrapper {
  border-radius: 20px 20px 0px 0px;
}
.btn-book {
  display: flex;
  justify-content: center;
}
.bg-overlay {
  background: linear-gradient(rgba(0, 0, 0, 0.3), rgba(0, 0, 0, 0.3)),
    url('../../assets/image/map.png');
  background-repeat: no-repeat;
  background-size: cover;
  background-position: center center;
  color: #fff;
  height: 200px;
  display: flex;
  align-items: center;
  justify-content: center;
  text-align: center;
  padding: 20px;
  border-radius: 10px 10px 0px 0px;
  position: relative;
}

.price {
  border-radius: 7px 7px 7px 0px;
}

@media (max-width: 768px) {
  .card-wrapper {
    width: 100%;
  }
}

.user-detail {
  background: #fff;
  padding: 20px;
  border-radius: 10px;
  color: #000;
  margin-bottom: 20px;
}

h1 {
  text-align: center;
  font-size: 20px;
  font-weight: bold;
  color: #000;
}

.form-group label {
  display: block;
  margin-top: 10px;
}

.form-group input,
.form-group select {
  width: calc(100% - 20px);
  padding: 5px;
  border: 1px solid #ccc;
  border-radius: 5px;
  box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.1);
}
.header-text {
  color: #000;
}
.header-detail {
  height: 100px;
  background-color: rgb(144, 124, 91);
}
.select {
  display: flex;
  justify-content: space-around; /* Centers items horizontally */
  align-items: center; /* Centers items vertically */
  border-radius: 5px;
  padding: 0.5rem 1rem;
  box-shadow: 0 1px 3px rgba(245, 242, 242, 0.1);
}

.menu-item {
  align-items: center;
  text-align: center;
  padding: 0.5rem;
  color: white;
  text-decoration: none;
  transition: background-color 0.3s ease;
  margin-right: 0.75rem;
}

.menu-item:hover {
  background-color: rgba(255, 255, 255, 0.1);
}

.menu-item i {
  margin-right: 0.5rem;
}

.bg-green {
  background-color: #38a169; /* Tailwind green color */
}

.bg-opacity-90 {
  background-color: rgba(56, 161, 105, 0.9); /* Adjusted opacity */
}

/*feedback*/
.contaner {
  width: 95%;
  color: #000;
  margin: 0 auto;
  padding: 20px;
  border-radius: 8px;
}

.head {
  text-transform: uppercase;
  margin-bottom: 20px;
}

.text {
  margin: 10px 0;
  font-family: sans-serif;
  font-size: 0.9em;
}

.comment {
  margin-bottom: 20px;
}

.comment-item {
  display: flex;
  align-items: flex-start;
  padding: 10px;
  margin-bottom: 10px;
}

.comment-item img {
  width: 40px;
  height: 40px;
  border-radius: 50%;
  margin-right: 20px;
  object-fit: cover;
  object-position: center;
}

.comment-content {
  width: 100%;
}

.comment-content h3 {
  font-size: 16px;
  margin: 0;
  margin-bottom: 5px;
}

.comment-content p {
  margin: 0;
  color: #555;
}

.commentbox {
  display: flex;
  align-items: flex-start;
  padding: 10px;
}

.commentbox img {
  width: 40px;
  height: 40px;
  border-radius: 50%;
  margin-right: 20px;
  object-fit: cover;
  object-position: center;
}

.content {
  width: 100%;
}

.user {
  width: 100%;
  padding: 10px;
  margin: 5px 0;
  border: 1px solid #ccc;
  border-radius: 4px;
  outline: none;
  color: #808080;
}

.commentinput {
  display: flex;
  flex-direction: column;
}

.usercomment {
  width: 100%;
  padding: 10px;
  border: none;
  border-bottom: 2px solid blue;
  outline: none;
}

.buttons {
  display: flex;
  justify-content: space-between;
  align-items: center;
  color: #808080;
  margin-top: 10px;
}

.buttons button {
  padding: 8px 16px;
  border: none;
  background-color: #007bff;
  color: #fff;
  border-radius: 4px;
  cursor: pointer;
}

.buttons button:disabled {
  background-color: #ccc;
}

.notify {
  display: flex;
  align-items: center;
  margin-left: 10px;
}

.notifyinput {
  margin-right: 5px;
}

.policy a {
  text-decoration: none;
  color: blue;
}
.action {
  margin-top: 20px;
  display: flex;
}
</style>
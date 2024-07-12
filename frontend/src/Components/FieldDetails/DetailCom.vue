<template>
  <WebHeaderMenu />
  <div class="header-text mt-5">
    <div class="header-detail">
      <div
        class="form-select absolute p-2 mt-17 bg-green bg-opacity-90 z-20 rounded-lg w-full md:w-5/5 lg:w-9/10 ml-16"
      >
        <div class="flex items-center justify-center space-x-2">
          <div class="relative flex gap-10 w-[334px]">
            <input
              type="text"
              v-model="searchQuery"
              placeholder="Search cards"
              class="p-2 rounded border w-80 h-13"
            />
          </div>
          <div class="relative flex gap-10 w-[334px]">
            <div class="absolute inset-y-0 start-0 flex items-center ps-3.5 pointer-events-none">
              <svg
                class="w-4 h-4 text-gray-500 dark:text-gray-400"
                aria-hidden="true"
                xmlns="http://www.w3.org/2000/svg"
                fill="currentColor"
                viewBox="0 0 20 20"
              >
                <path
                  d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z"
                />
              </svg>
            </div>
            <VueFlatpickr
              @change="bookingDate"
              v-model="booking_date"
              :config="flatpickrConfig"
              class="px-4 py-3 text-center bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
              placeholder="Select date"
            />
          </div>
          <form class="w-[334px] flex gap-2">
            <div class="flex gap-2">
              <label for="start_time" class="text-sm text-white" style="margin-top: 20px"
                >Start</label
              >
              <input
                @change="start"
                v-model="start_time"
                type="time"
                id="start_time"
                class="px-4 py-3 rounded-none rounded-s-lg bg-gray-50 border text-gray-900 leading-none focus:ring-blue-500 focus:border-blue-500 block flex-1 w-full text-sm border-gray-300 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                min="09:00"
                max="18:00"
                required
              />
            </div>
            <div class="flex gap-2">
              <label for="end_time" class="text-sm text-white" style="margin-top: 20px">End</label>
              <input
                @change="end"
                v-model="end_time"
                type="time"
                id="end_time"
                class="px-4 py-3 rounded-none rounded-s-lg bg-gray-50 border text-gray-900 leading-none focus:ring-blue-500 focus:border-blue-500 block flex-1 w-full text-sm border-gray-300 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                min="09:00"
                max="18:00"
                required
              />
            </div>
          </form>
        </div>
      </div>
    </div>
    <div class="mt-5 flex gap-5 ml-13 container">
      <div class="map-left w-80">
        <div class="card-me">
          <div class="card-wrapper relative w-full mx-2 my-2 border-1 border-gray-400 rounded-md">
            <div
              class="container bg-overlay"
              :style="{
                background: `linear-gradient(rgba(0, 0, 0, 0.3), rgba(0, 0, 0, 0.3)), url(${getImageUrl(field.image)})`
              }"
            >
              <div class="flex">
                <div
                  class="row text-center flex justify-start h-full"
                  style="margin-top: -78px; margin-left: -86px"
                >
                  <button class="bg-yellow-400 w-30 p-2 text-dark text-bold rounded-l">
                    ${{ field.price }}.00/Hour
                  </button>
                </div>
                <div class="row text-center flex flex-col items-center justify-center h-full">
                  <button type="button" class="btn btn-primary btn-details py-2 me-2">
                    Show on map
                  </button>
                </div>
              </div>
            </div>
            <div class="text text-start bg-white p-4 flex flex-col">
              <h5 class="text-2xl font-bold text-white py-2 mb-2 bg-green-500">Available</h5>
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
            <div class="form-group">
              <label for="duration">Your duration (hour) *</label>
              <input type="text" id="duration" v-model="duration" disabled />
            </div>
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
              <div class="flex items-center">
                <input
                  id="laravel-checkbox"
                  type="checkbox"
                  value=""
                  class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500"
                />
                <label
                  for="laravel-checkbox"
                  class="w-full py-2 ms-2 text-sm font-medium text-gray-900 dark:text-gray-300"
                  >Team Duncing</label
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

      <div class="map-right w-244 mt-2">
        <!-- w-96 sets a fixed width for the right div -->
        <div class="w-full w-214">
          <!-- <h2 class="text-2xl font-bold">7Seasons Apartments offers</h2> -->
          <img :src="getImageUrl(field.image)" alt="" class="w-full h-74 object-cover" />
        </div>
        <div v-for="card in filteredCards" :key="card.id" class="gap-2">
          <div class="card-text mt-4">
            <div class="card-display-container gap-3 flex flex-col">
              <div
                class="card-display border border-gray-400 rounded-lg shadow-lg flex overflow-hidden"
              >
                <div class="relative w-1/3 p-2">
                  <img
                    src="../../assets/image/contact-imag.jpg"
                    alt=""
                    class="w-full h-66 object-cover rounded-md"
                    style="border-radius: 10px"
                  />
                  <span
                    class="absolute top-5 right-5 bg-white rounded-full p-1 shadow-md cursor-pointer"
                  >
                    <img src="../../assets/image/heart.png" alt="Heart icon" class="w-8 h-8 p-1" />
                  </span>
                </div>
                <div class="flex flex-col justify-between p-4 w-2/3">
                  <div class="mb-2">
                    <h3 class="text-xl font-bold text-gray-900 mb-2">
                      <strong class="text-orange font-bold">{{ card.title }}</strong>
                    </h3>
                    <p class="text-gray-700">{{ card.description }}</p>
                  </div>
                  <div class="text-gray-700">
                    <p class="mt-2 cursor-pointer">
                      <span class="price bg-blue-500 text-white p-2 rounded-md mr-2">{{
                        card.price
                      }}</span>
                    </p>
                    <div class="rating mt-3">
                      <template v-for="n in card.rating">
                        <span class="star">&#9733;</span>
                      </template>
                      <template v-for="n in 5 - card.rating">
                        <span class="star">&#9734;</span>
                      </template>
                    </div>
                    <span class="viewer">{{ card.reviews }} reviews</span>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Add Map and Card  -->
  </div>
  <!-- =======================add comment ======================== -->
  <div class="container mx-auto mt-10 p-4 bg-white shadow-md rounded">
    <h2 class="text-2xl text-black font-bold mb-4">Commented</h2>
    <div class="mb-4">
      <div class="container mx-auto mt-10 p-4">
        <div class="group-form d-flex" v-for="feedback in Feedbacklist" :key="feedback.id">
          <div class="flex items-center mb-4">
            <div class="flex-grow flex items-center">
              <!-- Profile icon -->
              <svg
                xmlns="http://www.w3.org/2000/svg"
                class="h-6 w-6 text-gray-400 mr-2"
                viewBox="0 0 20 20"
                fill="none"
                stroke="currentColor"
                stroke-width="2"
                stroke-linecap="round"
                stroke-linejoin="round"
              >
                <circle cx="10" cy="10" r="9" />
                <path d="M16 16s-1.5-2-4-2-4 2-4 2" />
                <path d="M9 10s2-3.5 4-3.5 4 3.5 4 3.5" />
                <circle cx="10" cy="12" r="3" />
              </svg>
              <!-- Static content for profile -->
              <span class="text-gray-600"></span>
            </div>
          </div>
          <div class="flex items-center mb-4 ml-4 d-inline">
            <span class="text-black">{{ feedback.user.name }} - {{ feedback.created_at }}</span>
            <div class="flex-grow">
              <label for="name" class="block text-gray-700 w-100">{{
                feedback.feedback_text
              }}</label>
            </div>
            <div class="flex justify-end">
              <button
                @click="showEditModal(feedback)"
                class="px-2 py-1 bg-blue-500 text-white font-semibold rounded-md shadow hover:bg-blue-600 mr-2"
              >
                Edit
              </button>

              <button
                @click="deleteItem(feedback.id)"
                class="px-2 py-1 bg-red-500 text-white font-semibold rounded-md shadow hover:bg-red-600"
              >
                Delete
              </button>
            </div>
          </div>
        </div>
      </div>
      <h2 class="text-black">Add comment here</h2>
      <textarea
        id="comment"
        name="comment"
        rows="4"
        v-model="feedback_text"
        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-xl text-black"
        required
      ></textarea>
    </div>
    <div class="flex justify-end">
      <button
        @click="SubmitFeedback"
        class="px-4 py-2 bg-indigo-500 text-white font-semibold rounded-md shadow hover:bg-indigo-600"
      >
        Submit
      </button>
    </div>
  </div>
  <!-- =====================================================done ============ -->
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
</template>

<!-- =================================================== -->
<script setup lang="ts">
import WebHeaderMenu from '@/Components/WebHeaderMenu.vue'
import { ref, computed, watch, onMounted } from 'vue'
import VueFlatpickr from 'vue-flatpickr-component'
import 'flatpickr/dist/flatpickr.css'
import { useRoute, useRouter } from 'vue-router'
import axiosInstance from '@/plugins/axios'
import axios from 'axios'
import { ElMessage, ElMessageBox } from 'element-plus'
import type { Action } from 'element-plus'

const route = useRoute()
const router = useRouter()
const userId = computed(() => route.query.user)
const fieldId = computed(() => route.params.id)
const start_time = ref('')
const end_time = ref('')
const total_price = ref('00.00')
const booking_date = ref<Date | null>(null)
const bookings = ref<any[]>([])
const field = ref({})
const first_name = ref('')
const last_name = ref('')
const email = ref('')
const phone_number = ref('')
const price = ref(0)
const booking = ref({})
const searchQuery = ref('')
const feedback_text = ref('')
const Feedbacklist = ref([])
const isclear = ref(false)

const start = () => start_time.value
const end = () => end_time.value
const bookingDate = () => booking_date.value
const duration = ref(0)
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
      start_time: start(),
      end_time: end(),
      booking_date: bookingDate(),
      total_price: total_price.value,
      status: 'pending',
      payment_status: 'unpaid'
    })

    bookings.value.push(response.data)
    booking.value = response.data.data
    router.push({
      path: `/payment/${userId.value}`,
      query: { booking: booking.value.id }
    })
  } catch (error) {
    console.error('Error creating booking:', error)
  }
}
const SubmitFeedback = async () => {
  try {
    const response = await axiosInstance.post('/feedback/create', {
      user_id: userId.value,
      field_id: fieldId.value,
      feedback_text: feedback_text.value
    })
    alert('Create successfull')
    isclear.value = true
    clearFeedbackData()
  } catch (error) {
    alert('create fail')
    console.error('Error creating booking:', error)
  }
}

const fetchFields = async () => {
  try {
    const response = await axiosInstance.get(`/field/show/${fieldId.value}`)
    field.value = response.data.data
    price.value = field.value.price
  } catch (error) {
    console.error('Error fetching fields:', error)
  }
}
const clearFeedbackData = () => {
  feedback_text.value = ''
}
onMounted(() => {
  fetchFields()
  fetchFeedbackList()
  if (isclear.value) {
    clearFeedbackData()
  }
})

const fetchFeedbackList = async () => {
  try {
    const response = await axiosInstance.get('/feedbacks', {
      headers: {
        Authorization: `Bearer ${localStorage.getItem('access_token')}`
      }
    })
    Feedbacklist.value = response.data.data
    console.log(Feedbacklist.value)
  } catch (error) {
    console.error('Error fetching feedbacks:', error)
  }
}
const deleteItem = async (itemId) => {
  try {
    await axios.delete(`http://127.0.0.1:8000/api/feedback/delete/${itemId}`, {
      headers: {
        Authorization: `Bearer ${localStorage.getItem('access_token')}`
      }
    })
    Feedbacklist.value = Feedbacklist.value.filter((item) => item.id !== itemId)
  } catch (error) {
    console.error('Error deleting item:', error)
  }
}

const editFeedbackModalVisible = ref(false)
const editedFeedbackText = ref('')
let feedbackToEdit = null

const showEditModal = (feedback) => {
  feedbackToEdit = feedback
  editedFeedbackText.value = feedback.feedback_text
  editFeedbackModalVisible.value = true
}

const closeEditModal = () => {
  editFeedbackModalVisible.value = false
}

const updateFeedback = async () => {
  try {
    const response = await axiosInstance.put(`/feedback/update/${feedbackToEdit.id}`, {
      feedback_text: editedFeedbackText.value
    })
    const updatedFeedbackIndex = Feedbacklist.value.findIndex(
      (item) => item.id === feedbackToEdit.id
    )
    if (updatedFeedbackIndex !== -1) {
      Feedbacklist.value[updatedFeedbackIndex].feedback_text = editedFeedbackText.value
    }
    closeEditModal()
    alert('Feedback updated successfully!')
  } catch (error) {
    alert('Failed to update feedback.')
    console.error('Error updating feedback:', error)
  }
}

const getImageUrl = (imagePath) => {
  return imagePath ? `http://127.0.0.1:8000/storage/${imagePath}` : '/default-image.jpg'
}

watch([start_time, end_time], calculateTotalPrice)

const filteredCards = computed(() => {
  if (!searchQuery.value.trim()) {
    return cardItems.value
  }
  const query = searchQuery.value.trim().toLowerCase()
  return cardItems.value.filter((card) => {
    // Adjust this based on your card structure and what fields you want to search in
    return (
      card.title.toLowerCase().includes(query) || card.description.toLowerCase().includes(query)
    )
  })
})
// Mock data for demonstration, replace with actual data from API or Vuex store
const cardItems = ref([
  {
    id: 1,
    title: '7 Seasons Apartments',
    description:
      'Metro access Featuring a 24-hour reception, the 7Seasons Apartments offers you from Deak Ferenc tér, which is a major public transport...',
    price: '$10.00',
    rating: 4,
    reviews: 2965,
    imageUrl: '../../assets/image/contact-imag.jpg'
  },
  {
    id: 2,
    title: 'Window',
    description: 'Which is a major public transport...',
    price: '$10.00',
    rating: 4,
    reviews: 2965,
    imageUrl: '../../assets/image/contact-imag.jpg'
  },
  {
    id: 3,
    title: 'BudapestOpens',
    description: 'Metro access Featuring...',
    price: '$10.00',
    rating: 4,
    reviews: 2965,
    imageUrl: '../../assets/image/contact-imag.jpg'
  }
])
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
  /* background: linear-gradient(rgba(0, 0, 0, 0.3), rgba(0, 0, 0, 0.3)),
    url('../../assets/image/field.png'); */
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
</style>

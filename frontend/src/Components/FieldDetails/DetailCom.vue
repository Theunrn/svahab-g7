<template>
  <!-- <WebHeaderMenu/> -->
  <div class="header-text mt-5">
    <div class="header-detail">
      <div class="select absolute mt-17 bg-green bg-opacity-900 z-20 rounded-lg w-full md:w-5/5 lg:w-9/10 ml-16 flex justify-center items-center">
        <router-link href="#" class="menu-item">
          <i class="bx bx-home text-2xl"></i>
          <span>Home</span>
        </router-link>
        <router-link to="/scheduleField" href="#" class="menu-item">
          <i class="bx bx-calendar text-2xl"></i>
          <span>Schedule</span>
        </router-link>
        <router-link to="/lineUp" href="#" class="menu-item">
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
            <div
              class="container bg-overlay"
              :style="{
                background: `linear-gradient(rgba(0, 0, 0, 0.3), rgba(0, 0, 0, 0.3)), url(${getImageUrl(
                  field.image
                )})`
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
        <div class="gap-2 overflow-y-auto h-50">
          <div class="card-text mt-4">
            <div class="card-display-container gap-3 flex flex-col">
              <div
                class="card-display border border-gray-400 rounded-lg shadow-lg flex overflow-hidden"
                v-for="index in 3"
                :key="index"
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
                      <strong class="text-orange font-bold"
                        >7 Seasons Apartments BudapestOpens in new window</strong
                      >
                    </h3>
                    <p class="text-gray-700">
                      Metro access Featuring a 24-hour reception, the 7Seasons Apartments offers you
                      from Deak Ferenc tér, which is a major public transport...
                    </p>
                  </div>
                  <div class="text-gray-700">
                    <p class="mt-2 cursor-pointer">
                      <span class="price bg-blue-500 text-white p-2 rounded-md mr-2">$10.00</span>
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
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Add Map and Card  -->
  </div>
</template>

<script setup lang="ts">
import WebHeaderMenu from '@/Components/WebHeaderMenu.vue'
import { ref, computed, watch, onMounted } from 'vue'
import VueFlatpickr from 'vue-flatpickr-component'
import 'flatpickr/dist/flatpickr.css'
import { useRoute, useRouter } from 'vue-router'
import axiosInstance from '@/plugins/axios'

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
const start = () => start_time.value
const end = () => end_time.value
const bookingDate = () => booking_date.value
const duration = ref(0)
const isBook = ref(false)
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

    //create event 
    try {
      const startDateTime = `${bookingDate()} ${start()}:00`;
      const endDateTime = `${bookingDate()} ${end()}:00`;
      const response = await axiosInstance.post('/event/create', {
        field_id: fieldId.value,
        title: `Booking for ${field.value.name}`,
        start: startDateTime, // Convert date to ISO string format
        end: endDateTime, // Assuming end time should be the same as start time
      });

      console.log('Event created:', response.data)
    } catch (error) {
      console.error('Error creating event:', error)
    }
    // Navigate to the payment route with the booking ID
    alert('Thank you for your booking! We will send you a notification soon')
    router.push({
      path: `/payment/${userId.value}`,
      query: { booking: booking.value.id }
    })
  } catch (error) {
    alert('Your booking is failed. Please try again')
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

onMounted(() => {
  fetchFields()

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

.form-group input {
  width: calc(100% - 20px);
  padding: 5px;
  border: 1px solid #ccc;
  border-radius: 5px;
  box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.1);
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



</style>
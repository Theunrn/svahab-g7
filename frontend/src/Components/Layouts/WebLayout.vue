<template>
  <WebHeaderMenu />
  <div class="relative h-screen w-screen mb-5">
    <!-- Full-screen background image -->
    <img src="@/assets/image/bg.jpg" alt="Background" class="absolute inset-0 w-full h-full object-cover" />
    <!-- Full-screen black overlay with content centered -->
    <div class="absolute inset-0 flex items-center justify-center bg-black bg-opacity-75">
      <div class="text-center mx-auto">
        <p class="text-white text-lg md:text-3xl mb-4 font-bold">
          <strong style=" font-size: 50px; color: orange; font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;">W</strong>elcome to Football Field Booking
        </p>
        <p class="text-white mb-8 md:text-xl">Find the best fields near you and start your game!</p>

        <div class="relative w-full">
          <input v-model="searchQuery"type="text" placeholder="Search by Name or Location....." class="w-full px-4 py-2 rounded-md text-black" />
          <button @click="searchFields" type="button" class="absolute right-0 top-0 bg-green-500 text-white px-4 py-2 rounded-md flex justify-center items-center gap-3">
            <svg class="w-4 h-4 text-white dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
            </svg>
            Search field here
          </button>
        </div>

      </div>
    </div>
    <div class="header-detail">
      <div class="form-select absolute p-2 mt-17 bg-green bg-opacity-90 z-20 rounded-lg w-full md:w-5/5 lg:w-9/10 ml-16">
        <div class="flex items-center justify-center space-x-2">
          <div class="relative flex gap-10 w-[334px]">
            <svg v-if="!selectedProvince" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="absolute top-1/2 left-4 transform -translate-y-1/2">
              <path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z" fill="#4B5563" />
            </svg>
            <select v-model="selectedProvince" class="flex-1 text-center pl-10 rounded-md text-black border-2 border-transparent focus:border-yellow-500" @change="filterFields" style="padding: 13px">
              <option value="">Find your field for playing</option>
              <option class="text-start" v-for="province in provinces" :key="province.value" :value="province.value">
                {{ province.icon }} {{ province.name }}
              </option>
            </select>
          </div>

          <div class="relative flex gap-10 w-[334px]">
            <div class="absolute inset-y-0 start-0 flex items-center ps-3.5 pointer-events-none">
              <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                <path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z" />
              </svg>
            </div>
            <VueFlatpickr v-model="dateRange" :config="flatpickrConfig" class="px-4 py-3 text-center bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Select date" />
          </div>

          <form class="w-[334px]">
            <div class="flex">
              <!-- Time input -->
              <input type="time" id="time" class="px-4 py-3 rounded-none rounded-s-lg bg-gray-50 border text-gray-900 leading-none focus:ring-blue-500 focus:border-blue-500 block flex-1 w-full text-sm border-gray-300 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" min="09:00" max="18:00" value="00:00" required />
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  <div class="div flex justify-content-center mt-3 relative z-10">
    <img width="18%" height="18%" src="../../assets/image/logo1.png" alt="" />
  </div>
  <GoogleMap />
  <div>
    <div v-if="filteredFields.length > 0" class="card-me flex flex-wrap justify-content-start align-items-start ml-10">
      <!-- Loop to generate cards based on filtered fields -->
      <div class="card-wrapper rounded-md shadow-lg relative w-1/3 sm:w-full mx-2 my-2" v-for="field in filteredFields" :key="field.id">
        <div class="container bg-overlay" :style="{ background: `linear-gradient(rgba(0, 0, 0, 0.3), rgba(0, 0, 0, 0.3)), url(${getImageUrl(field.image)})` }">
          <div class="row text-center flex flex-col items-center justify-center h-full">
            <div class="btn-group">
              <router-link :to="{ path: '/field/detail/' + field.id, query: { customer: customer.id } }">
                <button type="button" class="btn btn-warning btn-details py-1 me-2 text-secondary">
                  <font-awesome-icon :icon="['fas', 'info-circle']" class="me-1" /> Book Now
                </button>
              </router-link>
            </div>
          </div>
        </div>
        <div class="text-start p-4">
          <div class="text-start">
            <h3 class="text-1xl font-bold text-gray-900 mb-2">{{ field.name }}</h3>
            <p class="mt-3 flex items-center gap-2">
              <span class="dollar bg-blue text-white p-1 rounded-md"> ${{ field.price }}.00 </span>
              <svg width="16" height="16" viewBox="0 0 24 24" fill="none"  xmlns="http://www.w3.org/2000/svg" >
                <path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21 12 17.27z" fill="#FCD34D" />
              </svg>
              <svg  width="16"  height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" >
                <path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21 12 17.27z" fill="#FCD34D" />
              </svg>
              <svg width="16" height="16" viewBox="0 0 24 24"  fill="none"  xmlns="http://www.w3.org/2000/svg" >
                <path  d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21 12 17.27z" fill="#FCD34D"  />
              </svg>
              <svg width="16"  height="16"  viewBox="0 0 24 24"  fill="none" xmlns="http://www.w3.org/2000/svg" >
                <path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21 12 17.27z"  fill="#FCD34D" />
              </svg>
              <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" >
                <path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21 12 17.27z" fill="#FCD34D"/>
              </svg>
            </p>
            <p class="mt-2 flex items-center gap-2">
              <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" >
                <path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z" fill="#4B5563" />
              </svg>
              {{ field.location }}
            </p>
          </div>
          <div class="text-right">
            <p class="mt-2">Starting from</p>
            <h3 class="text-1xl font-bold text-gray-900 mb-1">KHR {{ field.price * 4050 }}</h3>
          </div>
        </div>
      </div>
    </div>
    <div v-else class="text-center mt-10 text-green text-2xl flex justify-center">
      <img width="300" height="300" src="../../assets/image/404.png" alt="">
    </div>
  </div>
</template>


<script setup lang="ts">
import { ref, watch, onMounted } from 'vue'
import WebHeaderMenu from '@/Components/WebHeaderMenu.vue'
import VueFlatpickr from 'vue-flatpickr-component'
import 'flatpickr/dist/flatpickr.css'
import axiosInstance from '@/plugins/axios'

const showDatePicker = ref(false)
const selectedProvince = ref('')
const dateRange = ref(null)
const flatpickrConfig = {
  mode: 'range',
  dateFormat: 'Y-m-d'
}

const props = defineProps({
  customer: Object
})

const searchQuery = ref('')
const fields = ref([])
const message = ref('')

const filteredFields = ref([])
const matchFields = ref([])
localStorage.setItem('filteredFields', matchFields.value)

const fetchFields = async () => {
  try {
    const response = await axiosInstance.get('/fields/list')
    fields.value = response.data.data
    filterFields()
  } catch (error) {
    console.error('Error fetching fields:', error)
  }
}

const filterFields = () => {
  if (selectedProvince.value) {
    filteredFields.value = fields.value.filter((field) => {
      return field.province.toLowerCase() === selectedProvince.value.toLowerCase()
    })

    if (filteredFields.value.length === 0) {
      message.value = 'Field Not Found'
    } else {
      message.value = ''
    }
  } else {
    filteredFields.value = fields.value
    message.value = ''
  }
}

const searchFields = () => {
  if (searchQuery.value) {
    const normalizedQuery = searchQuery.value.toLowerCase().trim()
    filteredFields.value = fields.value.filter((field) => {
      return (
        field.name.toLowerCase().includes(normalizedQuery) ||
        field.location.toLowerCase().includes(normalizedQuery)
      )
    })

    if (filteredFields.value.length === 0) {
      message.value = 'Field Not Found'
    } else {
      message.value = ''
    }
  } else {
    filterFields()
  }

}

watch(selectedProvince, () => {
  filterFields()
})

onMounted(() => {
  fetchFields().then(() => {
    filteredFields.value = fields.value
  })
})

const getImageUrl = (imagePath) => {
  return imagePath ? `http://127.0.0.1:8000/storage/${imagePath}` : '/default-image.jpg'
}

const provinces = ref([
  { name: 'Phnom Penh', value: 'phnom penh', icon: '📍' },
  { name: 'Battambang', value: 'battambang', icon: '📍' },
  { name: 'Siem Reap', value: 'siem reap', icon: '📍' },
  { name: 'Sihanoukville', value: 'sihanoukville', icon: '📍' },
  { name: 'Kampong Cham', value: 'kampong cham', icon: '📍' },
  { name: 'Kampong Chhnang', value: 'kampong chhnang', icon: '📍' },
  { name: 'Kampong Speu', value: 'kampong speu', icon: '📍' },
  { name: 'Kampong Thom', value: 'kampong thom', icon: '📍' },
  { name: 'Kampot', value: 'kampot', icon: '📍' },
  { name: 'Kandal', value: 'kandal', icon: '📍' },
  { name: 'Koh Kong', value: 'koh kong', icon: '📍' },
  { name: 'Kratié', value: 'kratie', icon: '📍' },
  { name: 'Mondulkiri', value: 'mondulkiri', icon: '📍' },
  { name: 'Pailin', value: 'pailin', icon: '📍' },
  { name: 'Preah Vihear', value: 'preah vihear', icon: '📍' },
  { name: 'Prey Veng', value: 'prey veng', icon: '📍' },
  { name: 'Pursat', value: 'pursat', icon: '📍' },
  { name: 'Ratanakiri', value: 'ratanakiri', icon: '📍' },
  { name: 'Stung Treng', value: 'stung treng', icon: '📍' },
  { name: 'Svay Rieng', value: 'svay rieng', icon: '📍' },
  { name: 'Takéo', value: 'takeo', icon: '📍' },
  { name: 'Oddar Meanchey', value: 'oddar meanchey', icon: '📍' },
  { name: 'Tboung Khmum', value: 'tboung khmum', icon: '📍' }
])
</script>
<style scoped>
/* Additional styling if needed */

.form-select {
  bottom: -35px;
}
/* You can adjust the opacity value to make the overlay lighter or darker */
.bg-opacity-75 {
  opacity: 0.8; /* Adjust this value as needed */
}

.font-bold {
  font-weight: bold;
}

.card-me {
  justify-content: left;
  align-items: start;
  text-align: left;
  flex-wrap: wrap;
}

.card-wrapper {
  width: 23%;
  height: 40%;
  transition: transform 0.3s ease;
  position: relative;
}

.card-wrapper:hover {
  transform: scale(1.05);
}

.dollar {
  border-radius: 5px 5px 5px 0px;
}

.bg-overlay {
  background: linear-gradient(rgba(0, 0, 0, 0.3), rgba(0, 0, 0, 0.3)),
    url('../../assets/image/field.png');
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
  border-radius: 6px 6px 0px 0px;
  position: relative;
}

.btn-group {
  position: absolute;
  bottom: 30px;
  width: 80%;
  display: flex;
  justify-content: center;
  opacity: 0;
  transition: opacity 0.3s ease, transform 0.3s ease;
  transform: translateY(20px);
}

/* Show buttons on hover */
.card-wrapper:hover .btn-group {
  opacity: 1;
  transform: translateY(0);
}

@media (max-width: 768px) {
  .card-wrapper {
    width: 100%;
  }
}
</style>
<template>
  <WebHeaderMenu />
  <div class="header-text">
    <div class="header-detail">
      <div class="form-select absolute p-2 mt-17 bg-green bg-opacity-90 z-20 rounded-lg w-full md:w-5/5 lg:w-9/10 ml-16">
        <div class="flex items-center justify-center space-x-2">
          <div class="relative flex gap-10 w-[334px]">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="absolute top-1/2 left-4 transform -translate-y-1/2">
              <path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z" fill="#4B5563" />
            </svg>
            <select v-model="selectedOption" class="flex-1 text-center pl-10 rounded-md text-black border-2 border-transparent focus:border-yellow-500" @change="handleChange" style="padding: 13px;" >
              <option disabled value="">Choose field for play</option>
              <option value="option1">PNC Stadium</option>
              <option value="option2">PSE Stadium</option>
              <option value="option3">Borey Solar Stadium</option>
              <option value="option3">G7 Stadium</option>
            </select>
          </div>

          <div class="relative flex gap-10 w-[334px]">
            <div class="absolute inset-y-0 start-0 flex items-center ps-3.5 pointer-events-none">
              <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                <path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z"/>
              </svg>
            </div>
            <VueFlatpickr v-model="dateRange" :config="flatpickrConfig" class="px-4 py-3 text-center bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Select date" />
          </div>

          <form class="w-[334px] ">
            <div class="flex ">
            <!-- Time input -->
              <input type="time" id="time" class="px-4 py-3 rounded-none rounded-s-lg bg-gray-50 border text-gray-900 leading-none focus:ring-blue-500 focus:border-blue-500 block flex-1 w-full text-sm border-gray-300 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" min="09:00" max="18:00" value="00:00" required>
              
            </div>
          </form>

          <button type="button" class="w-30 rounded-md bg-blue-500 text-white border-2 border-transparent focus:border-yellow-500" style="padding: 13px;">
            Search
          </button>
        </div>
      </div>
    </div>

    <div class="mt-5 flex gap-5 ml-13">
      <div class="map-left w-80">
        <!-- w-96 sets a fixed width for the left div -->
        <div class="card-me">
          <div class="card-wrapper relative w-full mx-2 my-2 border-1 border-gray-400 rounded-md">
            <div class="container bg-overlay">
              <div class="row text-center flex flex-col items-center justify-center h-full">
                <button type="button" class="btn btn-primary btn-details py-2 me-2">
                  Show on map
                </button>
              </div>
            </div>
            <div class="text-start bg-white p-4 flex flex-col">
              <p class="text-xl font-bold text-grey-900 mb-2">Available:</p>
              <p class="text-grey">Price:</p>
              <button class="match-btn mr-2 bg-orange-500 w-40 text-white rounded-md px-3 py-1 mt-2 mb-2 hover:bg-orange-600 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:ring-opacity-50 shadow-md hover:shadow-lg z-20">
                Booking Now
              </button>
            </div>
          </div>
          <div class="wrapper-card relative w-full mx-2 my-2 rounded-md">  
            <h3 class="mb-3 mt-2 font-semibold text-gray-900 dark:text-white">Technology</h3>
            <ul class="w-100 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white">
              <li class="w-full border-b border-gray-200 rounded-t-lg dark:border-gray-600">
                <div class="flex items-center ps-3">
                  <input id="vue-checkbox" type="checkbox" value="" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                  <label for="vue-checkbox" class="w-full py-3 ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Water</label>
                </div>
              </li>
              <li class="w-full border-b border-gray-200 rounded-t-lg dark:border-gray-600">
                <div class="flex items-center ps-3">
                  <input id="react-checkbox" type="checkbox" value="" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                  <label for="react-checkbox" class="w-full py-3 ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Towel</label>
                </div>
              </li>
              <li class="w-full border-b border-gray-200 rounded-t-lg dark:border-gray-600">
                <div class="flex items-center ps-3">
                  <input id="angular-checkbox" type="checkbox" value="" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                  <label for="angular-checkbox" class="w-full py-3 ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Ball</label>
                </div>
              </li>
              <li class="w-full border-b border-gray-200 rounded-t-lg dark:border-gray-600">
                <div class="flex items-center ps-3">
                  <input id="laravel-checkbox" type="checkbox" value="" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                  <label for="laravel-checkbox" class="w-full py-3 ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Bag</label>
                </div>
              </li>
            </ul>
          </div>
        </div>
  
      </div>
      <div class="map-right w-215 mt-2">
        <!-- w-96 sets a fixed width for the right div -->
        <div class="w-full w-214">
          <!-- <h2 class="text-2xl font-bold">7Seasons Apartments offers</h2> -->
          <img src="../../assets/image/contact-imag.jpg" alt="" class="w-full h-74 object-cover" />
        </div>
        <div class="gap-2">
          <div class="card-text mt-4">
            <div class="card-display-container gap-3 flex flex-col">
              <div class="card-display border border-gray-400 rounded-lg shadow-lg flex overflow-hidden">
                <div class="relative w-1/3 p-2">
                  <img
                    src="../../assets/image/contact-imag.jpg"
                    alt=""
                    class="w-full h-66 object-cover rounded-md"
                    style="border-radius: 10px"
                  />
                  <span
                    class="absolute top-5 right-5 bg-white rounded-full p-1 shadow-md cursor-pointer"
                    @click="tongleFevorite"
                  >
                    <img src="../../assets/image/heart.png" alt="Heart icon" class="w-8 h-8 p-1" />
                  </span>
                </div>
                <div class="flex flex-col justify-between p-4 w-2/3">
                  <div class="mb-2">
                    <h3 class="text-xl font-bold text-gray-900 mb-2">
                      <strong class="text-orange font-bold"
                        >7Seasons Apartments BudapestOpens in new window</strong
                      >
                    </h3>
                    <p class="text-gray-700">
                      Metro access Featuring a 24-hour reception, the 7Seasons Apartments offers you
                      from Deak Ferenc tér, which is a major public transport...
                    </p>
                  </div>
                  <div class="text-gray-700">
                    <p class="mt-2 cursor-pointer">
                      <span class="price bg-blue-500 text-white p-2 rounded-md mr-2">8.8 $</span
                      >2,965 reviews
                    </p>
                  </div>
                </div>
              </div>
              <div
                class="card-display border border-gray-400 rounded-lg shadow-lg flex overflow-hidden"
              >
                <div class="relative w-1/3 p-2">
                  <img
                    src="../../assets/contact-piture/match.jpg"
                    alt=""
                    class="w-full h-66 object-cover rounded-md"
                    style="border-radius: 10px"
                  />
                  <span
                    class="absolute top-5 right-5 bg-white rounded-full p-1 shadow-md cursor-pointer"
                    @click="tongleFevorite"
                  >
                    <img src="../../assets/image/heart.png" alt="Heart icon" class="w-8 h-8 p-1" />
                  </span>
                </div>
                <div class="flex flex-col justify-between p-4 w-2/3">
                  <div class="mb-2">
                    <h3 class="text-xl font-bold text-gray-900 mb-2">
                      <strong class="text-orange font-bold"
                        >7Seasons Apartments BudapestOpens in new window</strong
                      >
                    </h3>
                    <p class="text-gray-700">
                      Metro access Featuring a 24-hour reception, the 7Seasons Apartments offers you
                      from Deak Ferenc tér, which is a major public transport...
                    </p>
                  </div>
                  <div class="text-gray-700">
                    <p class="mt-2 cursor-pointer">
                      <span class="price bg-blue-500 text-white p-2 rounded-md mr-2">8.8 $</span
                      >2,965 reviews
                    </p>
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
import { ref } from 'vue'
import WebHeaderMenu from '@/Components/WebHeaderMenu.vue'
import VueFlatpickr from 'vue-flatpickr-component'
import 'flatpickr/dist/flatpickr.css';

const dateRange = ref(null);
const flatpickrConfig = {
  dateFormat: 'Y-m-d',
  // other options...
};

const selectedOption = ref('')
const handleChange = () => {
  console.log('Selected option:', selectedOption.value)
}

</script>


<style scoped>
/* Additional styling if needed */

.header-text {
  height: 100vh;
}
.header-detail {
  height: 100px;
  background-color: rgb(144, 124, 91);
}

.card-me {
  justify-content: start;
  align-items: start;
  text-align: left;
}

.card-wrapper {
  border-radius: 20px 20px 0px 0px;
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
</style>
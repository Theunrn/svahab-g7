<template>
  <WebHeaderMenu />
  <div class="relative h-screen w-screen mb-5">
    <!-- Full-screen background image -->
    <img
      src="@/assets/image/bg.jpg"
      alt="Background"
      class="absolute inset-0 w-full h-full object-cover"
    />
    <!-- Full-screen black overlay with content centered -->
    <div class="absolute inset-0 flex items-center justify-center bg-black bg-opacity-75">
      <div class="text-center max-w-md mx-auto">
        <p class="text-white text-lg md:text-3xl mb-4 font-bold">Book Your Football Field Now.</p>
        <p class="text-white mb-8 md:text-xl">Find the best fields near you and start your game!</p>
        <div class="relative w-full">
          <input type="text" placeholder="Search Find Field..." class="w-full px-4 py-2 rounded-md text-black"/>
          <button type="button" class="absolute right-0 top-0 bg-red-500 text-white px-4 py-2 rounded-md">
            Search
          </button>
        </div>
      </div>
    </div>
    <div class="header-detail">
      <div class="form-select absolute p-2 mt-17 bg-green bg-opacity-90 z-20 rounded-lg w-full md:w-5/5 lg:w-9/10 ml-16">
        <div class="flex items-center justify-center space-x-2">
          <div class="relative flex gap-10 w-[334px]">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="absolute top-1/2 left-4 transform -translate-y-1/2">
              <path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z" fill="#4B5563" />
            </svg>
            <select v-model="selectedOption" class="flex-1 text-center pl-10 rounded-md text-black border-2 border-transparent focus:border-yellow-500" @change="handleChange" style="padding: 13px;" >
              <option disabled value="">Choose field for play</option>
              <option value="option1">Option 1</option>
              <option value="option2">Option 2</option>
              <option value="option3">Option 3</option>
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
  </div>
</template>

<script setup lang="ts">
import { ref } from 'vue';
import WebHeaderMenu from '@/Components/WebHeaderMenu.vue'
import VueFlatpickr from 'vue-flatpickr-component';
import 'flatpickr/dist/flatpickr.css';

const showDatePicker = ref(false);
const dateRange = ref(null);
const flatpickrConfig = {
  mode: 'range',
  dateFormat: 'Y-m-d'
};

</script>

<style scoped>
/* Additional styling if needed */

.form-select {
  bottom: -35px;
}
/* You can adjust the opacity value to make the overlay lighter or darker */
.bg-opacity-75 {
  opacity: 0.80; /* Adjust this value as needed */
}

.font-bold {
  font-weight: bold;
}
</style>
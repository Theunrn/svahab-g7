<template>
  <div class="card-me flex flex-wrap justify-content-start align-items-start ml-5">
    <!-- Card 1 -->
    <div class="card-wrapper relative w-1/4 sm:w-full mx-2 my-5" v-for="index in 4" :key="index" >
      <div class="max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700 overflow-hidden">
        <!-- Card Image -->
        <router-link :to="{ name: 'Detail', params: { id: 1 } }">
          <img class="rounded-t-lg p-2" src="../../assets/image/field.png" alt="Football Stadium" />
        </router-link>
        <div class="p-4 relative z-10">
          <!-- Card Title -->
          <router-link :to="{ name: 'Detail', params: { id: 1 } }">
            <h5 class="mb-2 text-2xl text-info font-bold tracking-tight text-gray-900 dark:text-white">Football Stadium</h5>
          </router-link>
          <!-- Card Description -->
          <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">Here are the biggest enterprise technology acquisitions of 2021 so far, in reverse chronological order.</p>
          <!-- See Details Button -->
          <router-link :to="{ name: 'Detail', params: { id: 1 } }" class="me-2 inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-gray-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
            See Details
          </router-link>
          <!-- Book Now Button -->
          <router-link :to="{ name: 'Book', params: { id: 1 } }" class="me-2 inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
            Book Now
            <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
              <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
            </svg>
          </router-link>
        </div>
        <!-- Overlay for Hover Effect -->
        <div class="overlay absolute inset-0 flex items-center justify-center bg-black bg-opacity-50 opacity-0 transition-opacity duration-300">
          <p class="text-white text-center">Football Field Booking</p>
        </div>
      </div>
    </div>
    <!-- Repeat for other cards with unique IDs -->
  </div>
</template>
<style scoped>
.card-me {
  justify-content: center;
  flex-wrap: wrap;
}

.card-wrapper {
  width: 23%;
  transition: transform 0.3s ease;
}

.card-wrapper:hover {
  transform: scale(1.05);
}

.overlay {
  z-index: 5;
  background-color: rgba(0, 0, 0, 0.5);
  opacity: 0;
  transition: opacity 0.3s ease;
}

.card-wrapper:hover .overlay {
  opacity: 1;
}

@media (max-width: 768px) {
  .card-wrapper {
    width: 100%;
  }
}
</style>
<template>
  <div class="flex justify-center">
    <!-- Card Field Component -->
    <div class="card-me flex flex-wrap justify-start items-start ml-5">
      <!-- Repeat for each card -->
      <div class="card-wrapper relative w-full sm:w-1/4 mx-2 my-5" v-for="index in 4" :key="index">
        <div
          class="max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700 overflow-hidden"
        >
          <!-- Card Image -->
          <router-link :to="{ name: 'Detail', params: { id: index } }">
            <img
              class="rounded-t-lg p-2"
              src="../../assets/image/field.png"
              alt="Football Stadium"
            />
          </router-link>
          <div class="p-4 relative z-10">
            <!-- Card Title -->
            <router-link :to="{ name: 'Detail', params: { id: index } }">
              <h5
                class="mb-2 text-2xl text-info font-bold tracking-tight text-gray-900 dark:text-white"
              >
                Football Stadium {{ index }}
              </h5>
            </router-link>
            <!-- Card Description -->
            <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">
              Here are the biggest enterprise technology acquisitions of 2021 so far, in reverse
              chronological order.
            </p>
            <!-- See Details Button -->
            <router-link
              :to="{ name: 'Detail', params: { id: index } }"
              class="me-2 inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-gray-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
            >
              See Details
            </router-link>
            <!-- Book Now Button -->
            <button
              @click="toggleDetails(index)"
              class="me-2 inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
            >
              Book Now
              <svg
                class="rtl:rotate-180 w-3.5 h-3.5 ms-2"
                aria-hidden="true"
                xmlns="http://www.w3.org/2000/svg"
                fill="none"
                viewBox="0 0 14 10"
              >
                <path
                  stroke="currentColor"
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  stroke-width="2"
                  d="M1 5h12m0 0L9 1m4 4L9 9"
                />
              </svg>
            </button>
          </div>
          <!-- Overlay for Hover Effect -->
          <div
            class="overlay absolute inset-0 flex items-center justify-center bg-black bg-opacity-50 opacity-0 transition-opacity duration-300"
          >
            <p class="text-white text-center">Football Field Booking</p>
          </div>
        </div>
      </div>
      <!-- End of card -->
    </div>

    <!-- Field Detail Component -->
    <div v-if="showFieldDetails" class="max-w-5xl mx-auto px-4 py-8 w-full sm:w-3/4">
      <!-- Header section with field image -->
      <div class="mb-4">
        <img :src="field.imageUrl" alt="Football Field" class="w-full rounded-lg shadow-md" />
      </div>

      <!-- Field details section -->
      <div class="bg-white rounded-lg shadow-md p-6 mb-8">
        <!-- Name and Distance -->
        <div class="flex items-center justify-between mb-4">
          <h2 class="text-3xl font-bold text-gray-900">{{ field.name }}</h2>
          <div class="flex items-center space-x-2">
            <svg
              xmlns="http://www.w3.org/2000/svg"
              class="h-6 w-6 text-gray-600"
              viewBox="0 0 20 20"
              fill="currentColor"
            >
              <path
                fill-rule="evenodd"
                d="M2 10a8 8 0 1116 0 8 8 0 01-16 0zm8-7a7 7 0 00-7 7c0 2.183.993 5.278 3.402 9.27a.75.75 0 001.196 0C11.007 17.278 14 14.183 14 12a7 7 0 00-7-7zm0 3a4 4 0 100 8 4 4 0 000-8z"
                clip-rule="evenodd"
              />
            </svg>
            <span class="text-gray-600">{{ field.distance }} km</span>
          </div>
        </div>

        <!-- Map section -->
        <div class="mb-4">
          <h3 class="text-xl font-semibold text-gray-900 mb-2">Map</h3>
          <!-- Replace with your map component or iframe embed -->

          <div class="relative h-72">
            <img
              :src="field.mapUrl"
              alt="Map"
              class="absolute inset-0 w-full h-full object-cover rounded-lg shadow-md"
            />
            <!-- Add map icon or marker overlay if needed -->
          </div>
        </div>

        <!-- Rating section -->
        <div class="mb-4">
          <h3 class="text-xl font-semibold text-gray-900 mb-2">Rating</h3>
          <div class="flex items-center space-x-2">
            <svg
              xmlns="http://www.w3.org/2000/svg"
              class="h-6 w-6 text-yellow-500"
              viewBox="0 0 20 20"
              fill="currentColor"
            >
              <path
                fill-rule="evenodd"
                d="M10 2.05l2.902 6.63 6.765.62a.75.75 0 01.416 1.284l-4.96 4.17 1.482 6.725a.75.75 0 01-1.15.816L10 16.402l-6.515 3.878a.75.75 0 01-1.15-.816l1.482-6.725-4.96-4.17a.75.75 0 01.416-1.284l6.765-.62L10 2.05z"
                clip-rule="evenodd"
              />
            </svg>
            <span class="text-gray-600">4.5</span>
          </div>
        </div>
      </div>

      <!-- Tabs section for About, Reviews, Opening Hours -->
      <div class="bg-white rounded-lg shadow-md mb-8">
        <!-- Tabs navigation -->
        <div class="flex border-b border-gray-200">
          <button
            @click="activeTab = 'about'"
            :class="{ 'bg-blue-500 text-white': activeTab === 'about' }"
            class="py-2 px-4 hover:bg-blue-200 focus:outline-none"
          >
            About
          </button>
          <button
            @click="activeTab = 'reviews'"
            :class="{ 'bg-blue-500 text-white': activeTab === 'reviews' }"
            class="py-2 px-4 hover:bg-blue-200 focus:outline-none"
          >
            Reviews
          </button>
          <button
            @click="activeTab = 'openingHours'"
            :class="{ 'bg-blue-500 text-white': activeTab === 'openingHours' }"
            class="py-2 px-4 hover:bg-blue-200 focus:outline-none"
          >
            Opening Hours
          </button>
        </div>

        <!-- Tab content -->
        <div class="p-6">
          <div v-if="activeTab === 'about'">
            <h3 class="text-xl font-semibold text-gray-900 mb-4">About</h3>
            <p class="text-gray-700">{{ field.about }}</p>
          </div>
          <div v-else-if="activeTab === 'reviews'">
            <h3 class="text-xl font-semibold text-gray-900 mb-4">Reviews</h3>
            <!-- Replace with review component or list -->
            <div class="flex items-center space-x-2">
              <svg
                xmlns="http://www.w3.org/2000/svg"
                class="h-6 w-6 text-yellow-500"
                viewBox="0 0 20 20"
                fill="currentColor"
              >
                <path
                  fill-rule="evenodd"
                  d="M10 2.05l2.902 6.63 6.765.62a.75.75 0 01.416 1.284l-4.96 4.17 1.482 6.725a.75.75 0 01-1.15.816L10 16.402l-6.515 3.878a.75.75 0 01-1.15-.816l1.482-6.725-4.96-4.17a.75.75 0 01.416-1.284l6.765-.62L10 2.05z"
                  clip-rule="evenodd"
                />
              </svg>
              <span class="text-gray-600">4.5</span>
              <p class="text-gray-700">Excellent field! Will definitely come again.</p>
            </div>
          </div>
          <div v-else-if="activeTab === 'openingHours'">
            <h3 class="text-xl font-semibold text-gray-900 mb-4">Opening Hours</h3>
            <!-- Replace with opening hours table -->
            <table class="min-w-full bg-white border">
              <thead class="text-white bg-dark">
                <tr>
                  <th class="py-2 px-4 border-b">Day</th>
                  <th class="py-2 px-4 border-b">Opening Hours</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="(hours, day) in field.openingHours" :key="day">
                  <td class="py-2 px-4 border-b">{{ day }}</td>
                  <td class="py-2 px-4 border-b">{{ hours }}</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>

      <!-- Additional buttons section -->
      <div class="flex gap-3">
        <button
          class="py-2 px-5 border border-red-500 text-dark rounded-lg shadow-md hover:bg-red-600 focus:outline-none"
        >
          10$ (1 hour)
        </button>

        <button
          @click="toggleDetails()"
          class="py-2 px-5 bg-red-500 text-white rounded-lg shadow-md hover:bg-red-600 focus:outline-none"
        >
          Back to Cards
        </button>
      </div>
    </div>
  </div>
</template>

<script>
  export default {
    data() {
      return {
        activeTab: 'about', // Default active tab
        showFieldDetails: false, // Boolean to toggle field details visibility
        field: {
          name: 'Football Stadium',
          distance: 3.5,
          imageUrl: '../../assets/image/field.png', // Example image URL
          mapUrl: 'https://example.com/map', // Example map URL
          about:
            'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed lobortis varius justo, sed finibus arcu suscipit sed.',
          openingHours: {
            Monday: '9:00 AM - 5:00 PM',
            Tuesday: '9:00 AM - 5:00 PM',
            Wednesday: '9:00 AM - 5:00 PM',
            Thursday: '9:00 AM - 5:00 PM',
            Friday: '9:00 AM - 5:00 PM',
            Saturday: 'Closed',
            Sunday: 'Closed'
          }
          // Add more field details as needed
        }
      }
    },
    methods: {
      toggleDetails(index) {
        this.showFieldDetails = !this.showFieldDetails
      }
    }
  }
</script>

<style scoped>
  /* Add scoped styles here if needed */
  .card-me {
    display: flex;
    flex-wrap: wrap;
    justify-content: flex-start;
  }

  .card-wrapper {
    width: 100%;
    max-width: calc(25% - 2rem); /* Adjust based on your spacing requirements */
  }

  @media (max-width: 768px) {
    .card-me {
      flex-direction: column;
      align-items: center;
    }

    .card-wrapper {
      max-width: 100%;
      margin: 0 auto 2rem;
    }
  }
</style>

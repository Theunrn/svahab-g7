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
          <input
            type="text"
            placeholder="Search Find Field..."
            class="w-full px-4 py-2 rounded-md text-black"
          />
          <button
            type="button"
            class="absolute right-0 top-0 bg-red-500 text-white px-4 py-2 rounded-md"
          >
            Search
          </button>
        </div>
      </div>
    </div>
    <div class="form-select absolute p-2 bg-orange bg-opacity-90 z-20 rounded-lg w-full md:w-5/5 lg:w-9/10 ml-16">
      <div class="flex items-center justify-center space-x-2">
        <select id="large" class="flex-1 px-4 py-3 rounded-md text-black border-2 border-transparent focus:border-yellow-500">
          <option selected>Where are you going?</option>
          <option value="US">United States</option>
          <option value="CA">Canada</option>
          <option value="FR">France</option>
          <option value="DE">Germany</option>
        </select>
        <input
          type="text"
          placeholder="Check-in date - Check-out date"
          class="flex-1 px-4 py-3 rounded-md text-black border-2 border-transparent focus:border-yellow-500"
        />
        <input
          type="text"
          placeholder="2 adults · 0 children · 1 room"
          class="flex-1 px-4 py-3 rounded-md text-black border-2 border-transparent focus:border-yellow-500"
        />
        <button
          type="button"
          class="px-4 py-3 rounded-md bg-blue-500 text-white border-2 border-transparent focus:border-yellow-500"
        >
          Search
        </button>
      </div>
    </div>
  </div>
</template>

<script setup lang="ts">
import WebHeaderMenu from '@/Components/WebHeaderMenu.vue'
</script>

<style scoped>
/* Additional styling if needed */

.form-select {
  bottom: -35px;
}
</style>
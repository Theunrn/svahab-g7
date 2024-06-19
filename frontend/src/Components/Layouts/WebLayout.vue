<template>
  <WebHeaderMenu />
  <div class="md:px-50 h-full">
    <div class="h-full">
      <slot />
    </div>
  </div>
  <div class="relative h-screen w-screen">
    <!-- Full-screen background image -->
    <img src="@/assets/image/bg.jpg" alt="Background" class="absolute inset-0 w-full h-full object-cover" />
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
          <button type="button" class="absolute right-0 top-0 bg-red-500 text-white px-4 py-2 rounded-md">
            Search
          </button>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup lang="ts">
import WebHeaderMenu from '@/Components/WebHeaderMenu.vue'
</script>

<style scoped>
/* You can adjust the opacity value to make the overlay lighter or darker */
.bg-opacity-75 {
  opacity: 0.75; /* Adjust this value as needed */
}

.font-bold {
  font-weight: bold;
}
</style>

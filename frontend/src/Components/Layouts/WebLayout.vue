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
            v-model="searchQuery"
            placeholder="Search Find Field..."
            class="w-full px-4 py-2 rounded-md text-black"
          />
          <button
            type="button"
            @click="searchFields"
            class="absolute right-0 top-0 bg-red-500 text-white px-4 py-2 rounded-md"
          >
            Search
          </button>
        </div>
      </div>
    </div>
  </div>
  <div class="div flex justify-content-center mt-3 relative z-10">
    <img width="18%" height="18%" src="../../assets/image/logo1.png" alt="">
  </div>
  <FootballFields :search-query="searchQuery" />
</template>

<script setup lang="ts">
import WebHeaderMenu from '../WebHeaderMenu.vue';
import FootballFields from '../../Components/Cards/CardCom.vue';
import { ref } from 'vue';

const searchQuery = ref('');

const searchFields = () => {
  

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

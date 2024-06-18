<script setup lang="ts">
import WebHeaderMenu from '@/Components/WebHeaderMenu.vue'
</script>
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
      <!-- Content to overlay on the background image -->
      <div class="absolute inset-0 flex items-center justify-start" style="margin-left: 150px;" >
        <div class="backdrop-blur-lg bg-white bg-opacity-10 p-8 rounded-md text-center max-w-md ">
          <p class="text-white text-lg md:text-2xl mb-4">Book Your Football Field Now.</p>
          <p class="text-white mb-8">Find the best fields near you and start your game!</p>
          <input 
            type="text" 
            placeholder="Search Find Field..." 
            class="w-full px-4 py-2 rounded-md"
          />
        </div>
      </div>
    </div>

</template>

<script setup lang="ts"></script>

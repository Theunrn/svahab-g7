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
  <section class="bg-gray-100">
    <div class="container mx-auto py-12 px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-2 items-center gap-8">
            <div class="max-w-lg ml-15 mb-20">
                <h2 class="text-3xl font-extrabold text-gray-900 sm:text-4xl">About Us</h2>
                <p class="mt-4 text-gray-600 text-lg">SVAHAB is your ultimate destination for discovering, booking, and managing football field reservations. Whether you’re an amateur enthusiast or a seasoned player, our platform is designed to make your football experience seamless and enjoyable.</p>
                <div class="mt-8">
                    <a href="#" class="text-blue-500 hover:text-blue-600 font-medium">Learn more about us
                        <span class="ml-2">&#8594;</span></a>
                </div>
            </div>
            <div class="mt-12 md:mt-0 mr-15">
                <img src="../../assets/image/about.webp" alt="About Us Image" class="object-cover rounded-lg shadow-md">
            </div>
        </div>
    </div>
</section>

</template>

<script setup lang="ts"></script>

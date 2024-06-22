
<template>
    <footer class="bg-gray-800 text-white py-10">
      <div class="container mx-auto flex flex-wrap justify-between items-center">
        <!-- Logo and Description -->
        <div class="w-full md:w-1/3 mb-6 md:mb-0">
          <h2 class="text-2xl font-bold">Football Field Booking</h2>
          <p class="mt-2 text-gray-400">Book your favorite football fields easily and quickly.</p>
        </div>
  
        <!-- Navigation Links -->
        <div class="w-full md:w-1/3 mb-6 md:mb-0">
          <h3 class="text-xl font-semibold mb-4">Quick Links</h3>
          <ul class="list-none">
            <li class="mb-2">
              <router-link to="/" class="hover:text-blue-400">Home</router-link>
            </li>
            <li class="mb-2">
              <router-link to="/fields" class="hover:text-blue-400">Fields</router-link>
            </li>
            <li class="mb-2">
              <router-link to="/about" class="hover:text-blue-400">About Us</router-link>
            </li>
            <li class="mb-2">
              <router-link to="/contact" class="hover:text-blue-400">Contact Us</router-link>
            </li>
          </ul>
        </div>
  
        <!-- Contact Information -->
        <div class="w-full md:w-1/3">
          <h3 class="text-xl font-semibold mb-4">Contact Us</h3>
          <p class="text-gray-400 mb-2">
            <span class="font-bold">Address:</span> 123 Football St, City, Country
          </p>
          <p class="text-gray-400 mb-2">
            <span class="font-bold">Phone:</span> (123) 456-7890
          </p>
          <p class="text-gray-400 mb-2">
            <span class="font-bold">Email:</span> info@footballbooking.com
          </p>
        </div>
      </div>
  
      <!-- Social Media Icons -->
      <div class="container mx-auto flex justify-center mt-6">
        <a href="#" class="mx-2 text-gray-400 hover:text-blue-400">
          <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="w-6 h-6" viewBox="0 0 16 16">
            <path d="M8 0C3.58 0 0 3.58 0 8c0 3.534 2.292 6.507 5.45 7.562v-5.327H3.897V8H5.45V6.266C5.45 4.74 6.355 3.847 7.781 3.847c.801 0 1.491.062 1.688.09v1.955h-1.159c-.908 0-1.083.432-1.083 1.065V8h2.149l-.282 2.235H7.227V15.56C10.385 14.505 12.678 11.532 12.678 8c0-4.42-3.58-8-8-8z"/>
          </svg>
        </a>
        <a href="#" class="mx-2 text-gray-400 hover:text-blue-400">
          <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="w-6 h-6" viewBox="0 0 16 16">
            <path d="M16 3.038a6.558 6.558 0 01-1.884.516A3.293 3.293 0 0015.558 2a6.573 6.573 0 01-2.084.797A3.286 3.286 0 007.875 4.11a9.321 9.321 0 01-6.766-3.429A3.287 3.287 0 002.1 6.873 3.27 3.27 0 01.64 6.58v.036a3.28 3.28 0 002.633 3.218 3.283 3.283 0 01-1.482.056A3.287 3.287 0 004.079 13a6.591 6.591 0 01-4.077 1.406A9.314 9.314 0 004.13 15c6.067 0 9.383-5.027 9.383-9.383 0-.143-.003-.286-.01-.428A6.706 6.706 0 0016 3.038z"/>
          </svg>
        </a>
        <a href="#" class="mx-2 text-gray-400 hover:text-blue-400">
          <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="w-6 h-6" viewBox="0 0 16 16">
            <path d="M8 0C3.58 0 0 3.58 0 8c0 3.534 2.292 6.507 5.45 7.562v-5.327H3.897V8H5.45V6.266C5.45 4.74 6.355 3.847 7.781 3.847c.801 0 1.491.062 1.688.09v1.955h-1.159c-.908 0-1.083.432-1.083 1.065V8h2.149l-.282 2.235H7.227V15.56C10.385 14.505 12.678 11.532 12.678 8c0-4.42-3.58-8-8-8z"/>
          </svg>
        </a>
      </div>
  
      <!-- Footer Bottom Text -->
      <div class="container mx-auto text-center mt-6 text-gray-400">
        <p>&copy; 2024 Football Field Booking. All rights reserved.</p>
      </div>
    </footer>
</template>
<script setup lang="ts">

</script >

<style scope>

</style>
  
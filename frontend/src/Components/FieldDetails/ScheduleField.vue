<template>
    <!-- <WebHeaderMenu/> -->
    <div class="header-text mt-5">
      <div class="header-detail">
        <div class="select absolute mt-17 bg-green bg-opacity-900 z-20 rounded-lg w-full md:w-5/5 lg:w-9/10 ml-16 flex justify-center items-center">
          <router-link to="/field/detail" href="#" class="menu-item">
            <i class="bx bx-home text-2xl"></i>
            <span>Home</span>
          </router-link>
          <router-link to="/schedule" href="#" class="menu-item">
            <i class="bx bx-calendar text-2xl"></i>
            <span>Schedule</span>
          </router-link>
          <router-link to="/lineUp" href="#" class="menu-item">
            <i class="bx bx-line-chart text-2xl"></i>
            <span>Line Up</span>
          </router-link>
        </div>
      </div>
    </div>
  </template>
  
  <script setup lang="ts">
  
  </script>
  
  
  <style scoped>
  /* Additional styling if needed */
  .header-text {
    color: #000;
  }
  .header-detail {
    height: 100px;
    background-color: rgb(144, 124, 91);
  }
  .select {
    display: flex;
    justify-content: space-around; /* Centers items horizontally */
    align-items: center; /* Centers items vertically */
    border-radius: 5px;
    padding: 0.5rem 1rem;
    box-shadow: 0 1px 3px rgba(245, 242, 242, 0.1);
  }
  
  .menu-item {
    align-items: center;
    text-align: center;
    padding: 0.5rem;
    color: white;
    text-decoration: none;
    transition: background-color 0.3s ease;
    margin-right: 0.75rem;
  }
  
  .menu-item:hover {
    background-color: rgba(255, 255, 255, 0.1); 
  }
  
  .menu-item i {
    margin-right: 0.5rem; 
  }
  
  .bg-green {
    background-color: #38a169; /* Tailwind green color */
  }
  
  .bg-opacity-90 {
    background-color: rgba(56, 161, 105, 0.9); /* Adjusted opacity */
  }
  
  
  
  </style>
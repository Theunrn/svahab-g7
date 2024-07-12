<template>
  <div class="header-text mt-5">
    <div class="header-detail">
      <div class="select absolute mt-17 bg-green bg-opacity-900 z-20 rounded-lg w-full md:w-5/5 lg:w-9/10 ml-16 flex justify-center items-center">
        <router-link href="#" class="menu-item">
          <i class="bx bx-home text-2xl"></i>
          <span>Home</span>
        </router-link>
        <router-link to="/scheduleField" href="#" class="menu-item">
          <i class="bx bx-calendar text-2xl"></i>
          <span>Schedule</span>
        </router-link>
        <router-link to="/lineUp" href="#" class="menu-item">
          <i class="bx bx-line-chart text-2xl"></i>
          <span>Line Up</span>
        </router-link>
      </div>
      <div class="image-container">
        <img src="../../assets/image/background.jpg" alt="Background Image">
        <!-- Team Red Circles -->
        <div class="circle team-a" style="top: 60%; left: 8.4%;"></div>

        <div class="circle team-a" style="top: 30%; left: 22%;"></div>
        <div class="circle team-a" style="top: 45%; left: 18%;"></div>
        <div class="circle team-a" style="top: 76%; left: 18%;"></div>
        <div class="circle team-a" style="top: 92%; left: 22%;"></div>

        <div class="circle team-a" style="top: 30%; left: 32%;"></div>
        <div class="circle team-a" style="top: 60%; left: 32%;"></div>
        <div class="circle team-a" style="top: 92%; left: 32%;"></div>

        <div class="circle team-a" style="top: 30%; left: 43%;"></div>
        <div class="circle team-a" style="top: 60%; left: 43%;"></div>
        <div class="circle team-a" style="top: 92%; left: 43%;"></div>
        <!-- Team Blue Circles -->
        <div class="circle team-b" style="top: 30%; left: 58%;"></div>
        <div class="circle team-b" style="top: 60%; left: 58%;"></div>
        <div class="circle team-b" style="top: 92%; left: 58%;"></div>

        <div class="circle team-b" style="top: 30%; left: 68%;"></div>
        <div class="circle team-b" style="top: 60%; left: 68%;"></div>
        <div class="circle team-b" style="top: 92%; left: 68%;"></div>

        <div class="circle team-b" style="top: 30%; left: 78%;"></div>
        <div class="circle team-b" style="top: 45%; left: 83%;"></div>
        <div class="circle team-b" style="top: 76%; left: 83%;"></div>
        <div class="circle team-b" style="top: 92%; left: 78%;"></div>
        
        <div class="circle team-b" style="top: 60%; left: 93%;"></div>
      </div>
    </div>
  </div>
</template>

<script setup lang="ts">

</script>

<style scoped>
/* Additional styling if needed */
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

.image-container {
  width: 98vw; 
  height: 100vh; 
  overflow: hidden; 
  position: relative;
  background-position: center;
}

.image-container img {
  min-width: 100%;
  height: 80%;
  object-fit: cover; 
  position: absolute;
  margin: 10px;
  top: 19%;
  left: 0;
}

.circle {
  width: 30px;
  height: 30px;
  border-radius: 50%;
  position: absolute;
  transform: translate(-50%, -50%);
}

.team-a {
  background-color: rgba(221, 51, 51, 0.932); /* Red color with opacity */
}

.team-b{
  background-color: rgba(45, 45, 211, 0.938); /* Blue color with opacity */
}
</style>

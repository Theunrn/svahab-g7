<template>
  <div class="py-12 bg-gray-50 mb-5">
    <!-- <body class="bg-gray-100 text-gray-800"> -->
    <div class="container mx-auto p-4">
      <h1 class="text-3xl font-bold text-center mb-8">Football Match Schedule</h1>
      <!-- Match Card -->
      <div class="bg-white shadow-md rounded-lg mb-6 py-1 px-8">
        <div class="flex items-center justify-between p-2">
          <div class="flex items-center">
            <img src="../../assets/image/logo-team1.webp" alt="Team A Logo" width="80" height="80" class="border border-2 border-info avatar-img rounded-circle"/>
            <div>
              <h2 class="text-xl font-semibold mx-3">Team A</h2>
            </div>
          </div>
          <div class="text-center">
            <p class="text-gray-600">Place: Stadium XYZ</p>
          </div>
          <div class="text-center">
            <img width="80" height="80" src="../../assets/image/vs.png" alt="">
          </div>
          <div class="text-center">
            <p class="text-gray-600">Date: 2021-01-01</p>
            <p class="text-gray-600">Time: 18:00</p>
            <!-- <p class="text-gray-600">Place: Stadium XYZ</p> -->
          </div>
          <div class="flex items-center">
            <div>
              <h2 class="text-xl font-semibold mx-3">Team B</h2>
            </div>
            <img src="../../assets/image/logo-team2.jpg" alt="Team B Logo" width="80" height="80" class="border border-2 border-info avatar-img rounded-circle" />
          </div>
        </div>
      </div>

      <!-- Repeat Match Card as needed -->
    </div>
  </div>
</template>
  
  <script>
export default {}
</script>
  
  <style>
</style>
  
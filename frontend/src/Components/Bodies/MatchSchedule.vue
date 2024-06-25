<template>
  <div class="py-12 bg-gray-50 mb-5">
    <!-- <body class="bg-gray-100 text-gray-800"> -->
    <div class="container mx-auto p-4">
      <h1 class="text-3xl font-bold text-center mb-8">Football Match Schedule</h1>
      <!-- Match Card -->
      <div class="bg-white shadow rounded-lg py-1 px-8 ml-9 mr-9">
        <div class="flex items-center justify-between p-2">
          <div class="flex items-center">
            <img src="../../assets/image/logo-team1.webp" alt="Team A Logo" width="80" height="80" class="border border-2 border-info avatar-img rounded-circle"/>
            <div>
              <h2 class="text-xl font-semibold mx-3">Team A</h2>
            </div>
          </div>
          <div class="text-center">
            <img width="85" height="85" src="../../assets/image/vs.png" alt="">
            <span class="bg-orange w-20"></span>
          </div>
          <div class="flex items-center">
            <div>
              <h2 class="text-xl font-semibold mx-3">Team B</h2>
            </div>
            <img src="../../assets/image/logo-team2.jpg" alt="Team B Logo" width="80" height="80" class="border border-2 border-info avatar-img rounded-circle" />
          </div>
        </div>
      </div>
      <div class="flex justify-center">
        <div class="w-50 bg-blue text-center rounded-b-2xl relative text-white p-3">
          <span class="text-xl font-bold text-center p-1 relative z-10">Date: Monday, June 24, 2024</span> |
          <span class="text-xl font-bold text-center p-1 relative z-10">Time: 09: 00</span> | 
          <span class="text-xl font-bold text-center p-1 mb-3 relative z-10">Place: Stadium XYZ</span>
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
  
<template>
  <div class="container flex pt-3 font-sans flex items-center justify-center">
    <div class="picture-match w-300 mt-5 flex flex-col justify-center items-center">
      <div class="header text-center">
        <h1 class="text-5xl font-bold text-orange-500">We are finding</h1>
        <h2 class="text-3xl font-bold text-gray-700">match team for playing</h2>
      </div>
      <div class="text-center flex justify-center">
        <img src="../../assets/contact-piture/download-ball.png" alt="" class="w-80 h-80" />
      </div>
    </div>
    <div class="find-match flex flex-col items-center justify-center w-400">
      <div class="match-items grid grid-cols-1 gap-10">
        <div class="match-item text-center rounded-lg shadow-lg p-4 w-140 hover:scale-105 transition-transform duration-300">
          <div class="flex justify-center">
            <div class="bg-blue w-25 rounded-2xl relative">
              <div class="absolute top-0 left-0 w-full h-full bg-gradient-to-r from-blue-500 to-blue-700 opacity-50 rounded-2xl"></div>
              <p class="match-time text-center p-1 text-sm text-white font-bold text-orange-500 relative z-10">
                20:00 AM
              </p>
            </div>
          </div>
          <div class="team-info flex justify-between items-center">
            <div class="team-logo flex gap-2 p-2 relative z-10">
              <img src="../../assets/contact-piture/logo-team.jpg" alt="" class="w-20 h-20 object-cover rounded-full border-4 border-orange-500 overflow-hidden shadow-md"/>
              <p class="team-name mt-4 text-sm font-bold text-3xl">Team Name</p>
            </div>
            <div>
              <img src="../../assets/image/vs1.png" alt="" class="w-15 h-15 mr-14 animate-pulse" />
            </div>
            <button class="match-btn mr-1 bg-orange-500 text-white rounded-md px-3 py-1 mt-2 mb-2 hover:bg-orange-600 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:ring-opacity-50">
              Match Now
            </button>
          </div>
          <div>
            <div class="match-date text-sm text-white flex justify-center">
              <div class="w-40 bg-blue rounded-b-2xl relative">
                <div
                  class="absolute top-0 left-0 w-full h-full bg-gradient-to-r from-blue-500 to-blue-700 opacity-50 rounded-b-2xl"
                ></div>
                <p class="text-md font-bold p-1 relative z-10">SUNDAY, 21 JUNE, 2024</p>
              </div>
            </div>
          </div>
          <div class="location bg-orange-500 text-white rounded-md mt-2 px-3 py-1 text-sm font-bold text-center shadow-md">
            <button>Location</button>
          </div>
        </div>

        <!-- Add another card here -->

      </div>
    </div>
  </div>
</template>

<style>
@media (max-width: 640px) {
  .container {
    flex-wrap: wrap;
  }

  .picture-match {
    display: flex;
    justify-content: center;
    align-items: center;
  }
  .header {
    text-align: center;
    margin-left: 100px;
  }
}

.team-logo img {
  position: relative;
  z-index: 1;
}

.match-items {
  width: 100%;
}
</style>
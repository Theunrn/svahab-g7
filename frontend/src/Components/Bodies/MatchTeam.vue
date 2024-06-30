<template>
  <div class="team d-flex justify-content-between">
    <div class="container flex pt-3 font-sans flex items-center justify-center">
      <div class="ml-10 picture-match w-300 mt-5 flex flex-col justify-center items-center">
        <div class="header text-center">
          <h1 class="text-5xl font-bold text-orange-500">WE ARE FINDING</h1>
          <h2 class="text-3xl font-bold text-gray-700 mt-2">MATCH TEAM FOR PLAYING!</h2>
        </div>
        <div class="text-center flex justify-center">
          <img src="../../assets/contact-piture/download-ball.png" alt="" class="w-80 h-80" />
        </div>
      </div>
      <div class="find-match flex items-center justify-center w-400 ml-20 mb-10">
        <div class="match-items grid grid-cols-1 gap-10">
          <div
            class="match-item text-center rounded-lg shadow-lg p-3 mb-3 w-160 hover:scale-105 transition-transform duration-300"
          >
            <div class="flex justify-center">
              <div class="bg-blue w-30 rounded-2xl relative mb-2">
                <p
                  class="match-time text-center p-1 text-sm text-white font-bold text-orange-500 relative z-10"
                >
                  20:00 AM
                </p>
              </div>
            </div>
            <div class="team-info flex justify-between items-center relative z-10">
              <div class="relative z-40">
                <img
                  src="../../assets/contact-piture/logo-team.jpg"
                  alt=""
                  class="w-30 h-30 object-cover rounded-full border-4 border-orange-500 overflow-hidden shadow-md hover:shadow-lg animate-sink"
                />
              </div>
              <div class="team-logo flex items-center gap-2 p-2">
                <p class="team-name text-sm font-bold text-gray-700">Team Name</p>
              </div>
              <div class="flex justify-center items-center">
                <img
                  src="../../assets/image/vs1.png"
                  alt=""
                  class="vs w-19 h-19 mr-15 animate-pulse z-20"
                />
              </div>
              <button
                class="match-btn mr-2 bg-orange-500 text-white rounded-md px-3 py-1 mt-2 mb-2 hover:bg-orange-600 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:ring-opacity-50 shadow-md hover:shadow-lg z-20"
              >
                Match Now
              </button>
            </div>
            <div>
              <div class="match-date text-base text-white flex justify-center">
                <div class="w-50 bg-blue rounded-b-2xl relative">
                  <p class="text-sm font-bold p-1 relative z-10">SUNDAY, 21 JUNE, 2024</p>
                </div>
              </div>
            </div>
            <div class="location">
              <button
                class="font-bold py-2 px-4 mt-2 rounded-lg w-40 border-2 border-gray-400 hover:bg-blue-700 hover:text-white"
              >
                Location
              </button>
            </div>
          </div>

          <!-- Add another card here -->
        </div>
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
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
    <div id="carouselExampleInterval" class="carousel slide" data-bs-ride="carousel">
      <div class="carousel-inner">
        <div class="carousel-item active" data-bs-interval="10000" v-for="index in 2" :key="index">
          <div class="find-match flex flex-col items-center justify-center w-200">
            <div class="match-items grid grid-cols-1 gap-10">
              <div class="match-item text-center rounded-lg shadow-lg p-3 mb-3 w-150 hover:scale-105 transition-transform duration-300">
                <div class="flex justify-center">
                  <div class="bg-blue w-30 rounded-2xl relative mb-2">
                    <p class="match-time text-center p-1 text-sm text-white font-bold text-orange-500 relative z-10">
                      20:00 AM
                    </p>
                  </div>
                </div>
                <div class="team-info flex justify-between items-center relative z-10">
                  <div class="relative z-40">
                    <img src="../../assets/contact-piture/logo-team.jpg" alt="" class="w-30 h-30 object-cover rounded-full border-4 border-orange-500 overflow-hidden shadow-md hover:shadow-lg animate-sink" />
                  </div>
                  <div class="team-logo flex items-center gap-2 p-2">
                    <p class="team-name text-sm font-bold text-gray-700 font-size-5">Team Name</p>
                  </div>
                  <div class="flex justify-center items-center">
                    <img src="../../assets/image/vs1.png" alt="" class="vs w-19 h-19 mr-15 animate-pulse z-20" />
                  </div>
                  <button type="button" data-bs-toggle="modal" data-bs-target="#match" class="match-btn mr-2 bg-orange-500 text-white rounded-md px-3 py-1 mt-2 mb-2 hover:bg-orange-600 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:ring-opacity-50 shadow-md hover:shadow-lg z-20">
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
                  <button class="font-bold py-2 px-4 mt-2 rounded-lg w-40 border-2 border-gray-400 hover:bg-blue-700 hover:text-white">
                    Location
                  </button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleInterval" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
      </button>
      <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleInterval" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
      </button>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="match" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title text-2xl" id="exampleModalLabel">Please match your team for playing</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form @submit.prevent="createMatch">
              <div class="mb-3">
                <img width="100" height="100" src="../../assets/image/logo-team2.jpg" alt="logo">
              </div>
              <div class="mb-3">
                <label for="teamLogoInput" class="form-label">Upload your team logo *</label>
                <input type="file" name="team_logo" class="form-control" id="teamLogoInput" @change="handleFileUpload">
              </div>
              <div class="mb-3">
                <label for="teamNameInput" class="form-label">Team Name *</label>
                <input type="text" class="form-control" v-model="team_name" id="teamNameInput">
              </div>
              <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" id="agreementCheck">
                <label class="form-check-label" for="agreementCheck">Do you agree with that time and match</label>
              </div>
              <div class="flex justify-end">
                <button type="submit" class="btn btn-primary">Match</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

### Vue Component Script
```ts
<script setup lang="ts">
import { ref } from 'vue';
import axiosInstance from '@/plugins/axios';

const post_team_id = ref(1);
const team_name = ref('');
const team_logo = ref<File | null>(null);

const handleFileUpload = (event: Event) => {
  const target = event.target as HTMLInputElement;
  if (target.files && target.files[0]) {
    team_logo.value = target.files[0];
    console.log('File selected:', team_logo.value);
  }
};

const createMatch = async () => {
  try {
    const formData = new FormData();
    formData.append('post_team_id', post_team_id.value.toString());
    formData.append('team_name', team_name.value);
    if (team_logo.value) {
      formData.append('team_logo', team_logo.value);
    }

    // Log the formData entries for debugging
    formData.forEach((value, key) => {
      console.log(`${key}:`, value);
    });

    const response = await axiosInstance.post('/post/match', formData);
    alert('Match created successfully');
  } catch (error) {
    alert('Error creating match');
    console.error('Error creating match:', error.response ? error.response.data : error);
  }
};
</script>

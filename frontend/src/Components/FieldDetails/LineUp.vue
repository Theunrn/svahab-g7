<template>
  <div class="header-text mt-5">
    <div class="header-detail">
      <div
        class="select absolute mt-17 bg-green bg-opacity-900 z-20 rounded-lg w-full md:w-5/5 lg:w-9/10 ml-16 flex justify-center items-center"
      >
        <router-link
          :to="{ path: '/field/detail/' + fieldId, query: { customer: userId } }"
          class="menu-item"
        >
          <i class="bx bx-home text-2xl"></i>
          <span>Fields</span>
        </router-link>
        <router-link
          :to="{ path: '/scheduleField', query: { field: fieldId, user: userId } }"
          href="#"
          class="menu-item"
        >
          <i class="bx bx-calendar text-2xl"></i>
          <span>Schedule</span>
        </router-link>
        <router-link
          :to="{ path: '/lineUp', query: { field: fieldId, user: userId } }"
          href="#"
          class="menu-item bg-white text-dark border-t-4 border-orange-500"
        >
          <i class="bx bx-line-chart text-2xl"></i>
          <span>Line Up</span>
        </router-link>
        
        <select v-model="selectedOption" class="select-option ml-4 p-2 rounded-lg">
          <option disabled value="">Please select one</option>
          <option value="option1">Option 11 player</option>
          <option value="option2">Option 7 player</option>
        </select>
        
        <div class="relative flex gap-5">
          <input
            type="text"
            placeholder="Enter number of players"
            class="px-4 py-2 rounded-md text-black"
            v-model="formationInput"
            @input="formatCardNumber"
          />
          <button @click="clearInput" class="absolute right-0 top-0 bg-red-500 text-white px-4 py-2 rounded-md">
            Clear
          </button>
        </div>
      </div>
      <div class="image-container">
        <img src="../../assets/image/background.jpg" alt="Background Image" />
        <!-- Team A Circles -->
        <div
          v-for="(position, index) in formationTeamA"
          :key="index"
          :class="`circle team-a`"
          :style="{ top: position.top, left: position.left }"
        ></div>
        <!-- Team B Circles -->
        <div
          v-for="(position, index) in formationTeamB"
          :key="index"
          :class="`circle team-b`"
          :style="{ top: position.top, left: position.left }"
        ></div>
      </div>
    </div>
  </div>
</template>

<script setup lang="ts">
import { ref, computed, watch } from 'vue'
import { useRoute } from 'vue-router'

const route = useRoute()
const userId = computed(() => route.query.user as string)
const fieldId = computed(() => route.query.field as string)

const selectedOption = ref('')
const formationInput = ref('')
const formationTeamA = ref<{ top: string, left: string }[]>([])
const formationTeamB = ref<{ top: string, left: string }[]>([])

const updateFormation = () => {
  const inputValues = formationInput.value.trim().split(' ').map(num => Number(num));

  // Validate input format
  if (inputValues.some(num => isNaN(num) || num <= 0)) {
    console.error('Invalid input format');
    return;
  }

  // Clear previous formations
  formationTeamA.value = [];
  formationTeamB.value = [];

  const totalColumns = inputValues.length;
  const totalHeight = 100;
  const centerOffset = 50;
  const columnGap = 10; // Adjust this value to reduce the gap between columns

  for (let col = 0; col < totalColumns; col++) {
    const numPlayers = inputValues[col];
    const verticalGap = totalHeight / (numPlayers + 1);

    for (let i = 0; i < numPlayers; i++) {
      // Calculate the position relative to the center
      const topPosition = `${centerOffset + (i - (numPlayers - 1) / 2) * verticalGap + 10}%`;

      // Left side (Team A)
      formationTeamA.value.push({
        top: topPosition,
        left: `${55 - (col + 1) * 8}%`, // Adjust left position based on column number
      });

      // Right side (Team B)
      formationTeamB.value.push({
        top: topPosition,
        left: `${46 + (col + 1) * 8}%`, // Adjust left position based on column number
      });
    }
  }
}



const maxSum = 11
const formatCardNumber = () => {
  let cleanedInput = formationInput.value.replace(/\D/g, '');

  let sum = 0;
  for (let digit of cleanedInput) {
    sum += parseInt(digit);
  }

  cleanedInput = cleanedInput.replace(/(\d{1})(?=\d)/g, '$1 ');

  if (sum > maxSum) {
    let excess = sum - maxSum;
    let trimmedInput = cleanedInput.split(' ').join('');
    trimmedInput = trimmedInput.slice(0, -excess);

    formationInput.value = trimmedInput.replace(/(\d{1})(?=\d)/g, '$1 ');
  } else {
    formationInput.value = cleanedInput;
  }
}
const clearInput = ()=>{
  formationInput.value = '';
}

// Watch for changes in formationInput and update formation accordingly
watch(formationInput, updateFormation)
</script>

<style scoped>
.header-detail {
  height: 100px;
  background-color: rgb(144, 124, 91);
}

.select {
  display: flex;
  justify-content: space-around;
  align-items: center;
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
  background-color: #38a169;
}

.bg-opacity-90 {
  background-color: rgba(56, 161, 105, 0.9);
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
  background-color: rgba(221, 51, 51, 0.932);
}

.team-b {
  background-color: rgba(45, 45, 211, 0.938);
}

.select-option {
  background-color: white;
  color: black;
}
</style>

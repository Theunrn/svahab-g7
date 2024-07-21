<template>
  <div class="container mx-auto px-2 py-2">
    <div class="flex flex-col md:flex-row gap-5 ml-10 mr-5">
      <!-- Left Side -->
      <div class="left-content w-300 mb-5">
        <h1 class="text-4xl font-bold mb-4">Check Weather</h1>
        <p class="text-lg text-gray-700 mb-4">
          Get the latest weather updates for your area. We provide the current temperature,
          humidity, wind speed, and more. Just enter your city name to start. Stay informed about
          changing weather and plan your day with accurate, up-to-date info. Our service is quick,
          easy, and reliable.
        </p>
        <form @submit.prevent="handleSearch" class="flex relative shadow-lg mt-3 rounded-2xl">
          <input v-model="searchCity" class="flex-1 pr-16 px-3 py-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent rounded-l-md" type="search" placeholder="Search" aria-label="Search">
          <button class="absolute right-0 top-0 mt-2 mr-2 px-4 py-2 bg-transparent border border-black-500 text-green-500 rounded-md hover:bg-grey-500 hover:text-green rounded-r-md" type="submit">Search</button>
        </form>
      </div>

      <!-- Right Side (Weather Widget) -->
      <div class="weather-widget w-600 bg-gradient-to-r from-[#98AFC7] to-[#2B547E] text-white rounded-lg shadow-md p-4 text-white">
        <div class="bg-gradient-to-r from-[#98AFC7] to-[#778899] text-gray-800 p-4 rounded-lg shadow-md">
          <div class="flex justify-center text-center text-2xl text-white font-bold border-b border-white">
            <p>{{ city }}</p>
          </div>
          <div class="weather-display flex flex-col md:flex-row justify-between items-center mb-2 text-white">
            <div class="w-300 text-left">
              <div class="flex flex-col items-center">
                <img :src="iconUrl" alt="weather icon" class="w-24 h-24 mb-2" />
                <div class="text-xl">{{ weather ? weather.weather[0].description : 'No data' }}</div>
              </div>
            </div>
            <div class="weather-center w-200 text-right">
              <div class="text-center text-left">
                <div class="border-b border-whit text-left mt-2">
                  <div class="text-sm mb-2">{{ currentDateTime }}</div>
                  <div class="text-3xl font-bold mb-2">{{ currentTime }}</div>
                </div>
                <div class="text-sm text-left">
                  <div class="text-5xl font-bold mb-2">{{ weather ? weather.main.temp.toFixed(0) : 'N/A' }}°</div>
                  <div class="flex flex-column gap-2">
                    <span> Feels like: {{ weather ? weather.main.feels_like.toFixed(0) : 'N/A' }}° </span>
                    <span> Humidity: {{ weather ? weather.main.humidity : 'N/A' }}% </span>
                    <span> Wind: {{ weather ? weather.wind.speed.toFixed(0) : 'N/A' }} km/h </span>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- Weekly Forecast -->
          <div class="grid grid-cols-6 gap-2 text-center text-sm border-t border-white text-white">
            <div v-for="(day, index) in filteredForecast" :key="index">
              <div class="mt-2">{{ getDayName(day.date) }}</div>
              <img :src="getIconUrl(day.icon)" alt="weather icon" class="mx-auto my-2" />
              <div class="flex gap-4 ml-3">
                <span>{{ day.temp.max }}°</span>
                <span>{{ day.temp.min }}°</span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  data() {
    return {
      weather: null,
      forecast: [], // To store the 7-day forecast
      apiKey: '1d5b1ee8b600b4a9e279d0d3cdd57a23', // Your OpenWeatherMap API key
      city: 'Phnom Penh', // Default city
      searchCity: '', // Bind this to the input field
      currentTime: '', // Add currentTime to data
    };
  },
  computed: {
    iconUrl() {
      if (this.weather && this.weather.weather[0].icon) {
        return `http://openweathermap.org/img/wn/${this.weather.weather[0].icon}@2x.png`;
      }
      return '';
    },
    currentDateTime() {
      const options = { month: 'long', day: 'numeric', year: 'numeric' };
      return `Today, ${new Date().toLocaleDateString('en-US', options)}`;
    },
    filteredForecast() {
      // Find today's date
      const today = new Date().setHours(0, 0, 0, 0);
      // Filter out today's data and return the next 6 days
      return this.forecast.filter(day => new Date(day.date).setHours(0, 0, 0, 0) !== today).slice(0, 6);
    }
  },
  created() {
    this.fetchWeather();
    this.startTimeAnimation(); // Start updating the time
  },
  beforeUnmount() {
    this.stopTimeAnimation(); // Stop updating the time when component is unmounted
  },
  methods: {
    async fetchWeather(city = this.city) {
      try {
        const response = await axios.get(`https://api.openweathermap.org/data/2.5/weather?q=${city}&units=metric&appid=${this.apiKey}`);
        this.weather = response.data;
        this.city = city;
        this.fetchForecast(response.data.coord.lat, response.data.coord.lon);
      } catch (error) {
        console.error('Error fetching weather data:', error);
        this.weather = null;
        this.city = 'Phnom Penh'; // Revert to default city if error occurs
        this.fetchWeather('Phnom Penh'); // Fetch weather for default city
      }
    },
    async fetchForecast(lat, lon) {
      try {
        // Replace with random data generation for testing
        this.forecast = this.generateRandomForecast();
      } catch (error) {
        console.error('Error fetching forecast data:', error);
        this.forecast = [];
      }
    },
    generateRandomForecast() {
      const days = ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'];
      return days.map((day, index) => ({
        dt: Date.now() + index * 24 * 60 * 60 * 1000, // Mock date
        temp: {
          max: Math.floor(Math.random() * 35) + 15, // Random max temp between 15 and 50
          min: Math.floor(Math.random() * 15) + 5  // Random min temp between 5 and 20
        },
        icon: this.getRandomIcon(),
        date: new Date(Date.now() + index * 24 * 60 * 60 * 1000) // Date object for filtering
      }));
    },
    getRandomIcon() {
      const icons = ['01d', '02d', '03d', '04d', '09d', '10d', '11d', '13d', '50d'];
      return icons[Math.floor(Math.random() * icons.length)];
    },
    getIconUrl(icon) {
      return `http://openweathermap.org/img/wn/${icon}.png`;
    },
    getDayName(date) {
      const days = ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'];
      return days[new Date(date).getDay()];
    },
    handleSearch() {
      if (this.searchCity) {
        this.fetchWeather(this.searchCity);
        this.searchCity = ''; // Clear the input field
      }
    },
    getCurrentTime() {
      const currentDate = new Date();
      const cambodiaTime = new Date(currentDate.toLocaleString('en-US', { timeZone: 'Asia/Phnom_Penh' }));
      const formattedTime = date => String(date.getHours()).padStart(2, '0') + ':' + String(date.getMinutes()).padStart(2, '0') + ':' + String(date.getSeconds()).padStart(2, '0');
      return formattedTime(cambodiaTime);
    },
    startTimeAnimation() {
      this.currentTime = this.getCurrentTime(); // Initialize with the current time
      this.intervalId = setInterval(() => {
        this.currentTime = this.getCurrentTime();
      }, 1000); // Update every second
    },
    stopTimeAnimation() {
      if (this.intervalId) {
        clearInterval(this.intervalId);
      }
    }
  }
};
</script>

<style scoped>
.weather-widget {
  max-width: 600px;
  margin: 0 auto;
}

@media (max-width: 768px) {
  .left-content {
    width: 100%;
    order: 2;
  }

  /* .weather-center {
    text-align: center;
    margin-left: 600px;
  } */
  .weather-display {
    display: flex;
    flex-direction: row;
    justify-content: center;
    align-items: center;
  }
  .weather-widget {
    width: 100%;
    order: 1;
  }
}

@keyframes rain {
  to {
    transform: translateY(100vh);
  }
}

.rain {
  position: relative;
  overflow: hidden;
}

.rain::before {
  content: '';
  position: absolute;
  top: -100%;
  left: 0;
  width: 100%;
  height: 100%;
  background: rgba(255, 255, 255, 0.8);
  box-shadow: 0 0 5px rgba(255, 255, 255, 0.8);
  animation: rain 1s linear infinite;
  opacity: 0.5;
  pointer-events: none;
}

</style>
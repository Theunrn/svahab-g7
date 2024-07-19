<template>
  <div class="container mx-auto px-2 py-2">
    <div class="flex flex-col md:flex-row gap-5">
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
          <div class="flex flex-col md:flex-row justify-between items-center mb-2 text-white">
            <div class="w-300 text-left">
              <div class="flex flex-col items-center">
                <img :src="iconUrl" alt="weather icon" class="w-24 h-24 mb-2" />
                <div class="text-xl">{{ weather ? weather.weather[0].description : 'No data' }}</div>
              </div>
            </div>
            <div class="w-200 text-right">
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
          <div class="grid grid-cols-7 gap-2 text-center text-sm border-t border-white text-white">
            <div>
              <div>Mon</div>
              <img :src="iconUrl" alt="weather icon" class="mx-auto my-2" />
              <div class="flex gap-1 ml-3">
                <span>{{ weather ? weather.main.feels_like.toFixed(0) : 'N/A' }}°</span>
                <span>19°</span>
              </div>
            </div>
            <div>
              <div>Tue</div>
              <img :src="iconUrl" alt="weather icon" class="mx-auto my-2" />
              <div class="flex gap-1 ml-3">
                <span>{{ weather ? weather.main.feels_like.toFixed(0) : 'N/A' }}°</span>
                <span>19°</span>
              </div>
            </div>
            <div>
              <div>Wed</div>
              <img :src="iconUrl" alt="weather icon" class="mx-auto my-2" />
              <div class="flex gap-1 ml-3">
                <span>29°</span>
                <span>19°</span>
              </div>
            </div>
            <div>
              <div>Thu</div>
              <img :src="iconUrl" alt="weather icon" class="mx-auto my-2" />
              <div class="flex gap-1 ml-3">
                <span>{{ weather ? weather.main.feels_like.toFixed(0) : 'N/A' }}°</span>
                <span>19°</span>
              </div>
            </div>
            <div>
              <div>Fri</div>
              <img :src="iconUrl" alt="weather icon" class="mx-auto my-2" />
              <div class="flex gap-1 ml-3">
                <span>{{ weather ? weather.main.feels_like.toFixed(0) : 'N/A' }}°</span>
                <span>19°</span>
              </div>
            </div>
            <div>
              <div>Sat</div>
              <img :src="iconUrl" alt="weather icon" class="mx-auto my-2" />
              <div class="flex gap-1 ml-3">
                <span>29°</span>
                <span>19°</span>
              </div>
            </div>
            <div>
              <div>Sun</div>
              <img :src="iconUrl" alt="weather icon" class="mx-auto my-2" />
              <div class="flex gap-1 ml-3">
                <span>{{ weather ? weather.main.feels_like.toFixed(0) : 'N/A' }}°</span>
                <span>19°</span>
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
      const options = { weekday: 'long', month: 'long', day: 'numeric', year: 'numeric' };
      return new Date().toLocaleDateString('en-US', options);
    },
    currentDay() {
      return new Date().toLocaleDateString('en-US', { weekday: 'long' });
    },
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
        const response = await axios.get(`https://api.openweathermap.org/data/2.5/onecall?lat=${lat}&lon=${lon}&exclude=current,minutely,hourly,alerts&units=metric&appid=${this.apiKey}`);
        this.forecast = response.data.daily.slice(0, 7).map(day => ({
          dt: day.dt,
          temp: {
            max: day.temp.max,
            min: day.temp.min
          },
          icon: day.weather[0].icon
        }));
      } catch (error) {
        console.error('Error fetching forecast data:', error);
        this.forecast = [];
      }
    },
    getIconUrl(icon) {
      return `http://openweathermap.org/img/wn/${icon}.png`;
    },
    getDayName(index) {
      const days = ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'];
      return days[index];
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
      }, 1000);
    },
    stopTimeAnimation() {
      clearInterval(this.intervalId);
    }
  }
}
</script>

<style scoped>
.weather-widget {
  max-width: 600px;
  margin: 0 auto;
}
</style>
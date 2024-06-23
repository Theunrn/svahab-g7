<template>
  <div class="container mx-auto px-4">
    <div class="flex flex-col md:flex-row justify-between items-center gap-5">
      <!-- Left Side -->
      <div class="left-content md:w-1/2 mb-5 ml-5 md:mb-0">
        <h1 class="text-4xl font-bold mb-4">Check Weather</h1>
        <p class="text-lg text-gray-700">
          Get the latest weather updates for your area. We provide the current temperature, humidity, wind speed, and more. Just enter your city name to start. Stay informed about changing weather and plan your day with accurate, up-to-date info. Our service is quick, easy, and reliable.        
        </p>
        <form @submit.prevent="handleSearch" class="flex relative shadow-lg mt-3 rounded-2xl">
          <input v-model="searchCity" class="flex-1 pr-16 px-3 py-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent rounded-l-md" type="search" placeholder="Search" aria-label="Search">
          <button class="absolute right-0 top-0 mt-2 mr-2 px-4 py-2 bg-transparent border border-black-500 text-green-500 rounded-md hover:bg-grey-500 hover:text-green rounded-r-md" type="submit">Search</button>
        </form>
      </div>

      <!-- Right Side (Weather Widget) -->
      <div class="weather-widget md:w-1/2 mb-3 bg-gradient-to-r from-[#98AFC7] to-[#488AC7] hover:bg-gradient-to-r w-full rounded-lg shadow-md p-3 font-sans">
        <div class="weather-header text-center mb-3 border-b border-white">
          <h1 class="text-3xl font-bold mb-1 text-white">{{ city }}</h1>
        </div>
        <div class="weather-info flex items-center mb-5 gap-5">
          <div class="weather-icon flex flex-col justify-center items-center w-1/2">
            <img :src="iconUrl" alt="Weather Icon" class="w-40 h-35 mb-2" />
            <h2 class="text-3xl text-center font-bold text-white">{{ weather?.weather[0]?.description }}</h2>
          </div>
          <div class="w-1/2 flex flex-col justify-start">
            <div class="border-b border-white">
              <p class="font-bold text-sm mb-2 text-white">{{ currentDateTime }}</p>
              <h2 class="font-bold text-5xl mb-2 text-white">{{ currentTime }}</h2>
            </div>
            <div class="weather-details text-left">
              <p class="weather-temp text-5xl mb-1 font-bold text-white">{{ weather?.main?.temp }}°</p>
              <p class="weather-feels text-1xl text-white">Feels like: {{ weather?.main?.feels_like }}°</p>
              <p class="weather-humidity text-1xl text-white">Humidity: {{ weather?.main?.humidity }}%</p>
              <p class="weather-wind text-1xl text-white">Wind: {{ weather?.wind?.speed }} km/h</p>
            </div>
          </div>
        </div>
        <div class="weather-forecast flex justify-between border-t border-white">
          <div class="forecast-day flex flex-col justify-center text-center mt-2" v-for="day in forecast" :key="day.dt">
            <p class="mb-1 text-white">{{ day.day }}</p>
            <img :src="getIconUrl(day.icon)" alt="Weather Icon" class="w-7 h-7 mb-2" />
            <p class="mb-1 text-white">{{ day.temp.max }}°</p>
            <p class="text-white">{{ day.temp.min }}°</p>
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
        const dailyForecast = response.data.daily.slice(0, 7).map(day => ({
          dt: day.dt,
          day: new Date(day.dt * 1000).toLocaleDateString('en', { weekday: 'short' }),
          temp: day.temp,
          icon: day.weather[0].icon
        }));
        this.forecast = dailyForecast;
      } catch (error) {
        console.error('Error fetching forecast data:', error);
        this.forecast = [];
      }
    },
    getIconUrl(icon) {
      return `http://openweathermap.org/img/wn/${icon}.png`;
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
  max-width: 500px;
  margin: 0 auto;
}
</style>

<template>
  <div class="weather-widget bg-white rounded-lg shadow-md p-6 mb-8">
    <div v-if="weather">
      <div class="flex items-center justify-between mb-4">
        <div class="flex items-center">
          <img :src="iconUrl" alt="Weather Icon" class="w-12 h-12" />
          <div class="ml-4">
            <h3 class="text-2xl font-semibold text-gray-900">{{ weather.main.temp }}°C</h3>
            <p class="text-gray-600">{{ weather.weather[0].description }}</p>
          </div>
        </div>
      </div>
      <div class="flex justify-between text-gray-700">
        <p>Humidity: {{ weather.main.humidity }}%</p>
        <p>Wind: {{ weather.wind.speed }} m/s</p>
      </div>
    </div>
    <div v-else>
      <p>Loading weather data...</p>
    </div>
  </div>
</template>
  
  <script>
import axios from 'axios'

export default {
  data() {
    return {
      weather: null,
      apiKey: '1d5b1ee8b600b4a9e279d0d3cdd57a23', // Your OpenWeatherMap API key
      city: 'Phnom Penh' // Default city
    }
  },
  computed: {
    iconUrl() {
      if (this.weather && this.weather.weather[0].icon) {
        return `http://openweathermap.org/img/wn/${this.weather.weather[0].icon}@2x.png`
      }
      return ''
    }
  },
  created() {
    this.fetchWeather()
  },
  methods: {
    async fetchWeather() {
      try {
        const response = await axios.get(
          `https://api.openweathermap.org/data/2.5/weather?q=${this.city}&units=metric&appid=${this.apiKey}`
        )
        this.weather = response.data
      } catch (error) {
        console.error('Error fetching weather data:', error)
        // Optionally, set a default or fallback weather data
        this.weather = null
      }
    }
  }
}
</script>
  
  <style scoped>
.weather-widget {
  max-width: 400px;
  margin: 0 auto;
}
</style>
<template>
  <section class="container ui two column center">
    <div class="column">
      <form class="ui segment large form">
        <div class="ui message red"></div>
        <div class="ui segment">
          <div class="field">
            <div class="ui right icon input large">
              <input type="text" placeholder="Enter your address" v-model="address" />
              <i class="dot circle link icon"></i>
            </div>
          </div>
          <button type="button" class="btn bg-red-400 text-white" @click="go">Go</button>
        </div>
      </form>
    </div>
  </section>
</template>
  
<script>
  // ======================= import axios =======================
  import axios from 'axios'

  export default {
    data() {
      return {
        address: '', // Address obtained from geocoding
        location: null, // Store current location coordinates
        geocoder: null // Placeholder for geocoder instance (if needed in future)
      }
    },
    mounted() {
      this.locatorButtonPressed() // Automatically fetch address when component mounts
    },
    methods: {
      // ======================= Handle Locator Button Press =======================
      locatorButtonPressed() {
        if (navigator.geolocation) {
          navigator.geolocation.getCurrentPosition(
            (position) => {
              this.getAddressFrom(position.coords.latitude, position.coords.longitude)
              this.location = {
                lat: position.coords.latitude,
                lng: position.coords.longitude
              }
              this.$emit('location-updated', this.location) // Emit location to parent component
            },
            (error) => {
              console.log(error.message) // Log any geolocation errors
            }
          )
        } else {
          alert('Geolocation is not supported by this browser.') // Alert if geolocation is not supported
        }
      },
      
      // ======================= Fetch Address from Coordinates =======================
      getAddressFrom(lat, long) {
        axios
          .get(`https://nominatim.openstreetmap.org/reverse?format=json&lat=${lat}&lon=${long}`)
          .then((response) => {
            if (response.data.error) {
              console.log(response.data.error) // Log any errors from the geocoding service
            } else {
              this.address = response.data.display_name
              this.$emit('address-updated', this.address) // Emit the address to parent component
            }
          })
          .catch((error) => {
            console.log(error.message) // Log any errors from the HTTP request
          })
      },
      
      // ======================= Handle 'Go' Button Click =======================
      go() {
        console.log(this.address) // Log the address when 'Go' button is clicked
        // Add logic to handle the 'Go' button click
      }
    }
  }

</script>
  
<style>
  #map {
    height: 400px;
  }
</style>
  
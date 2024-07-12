<template>
    <!-- <section class="container ui two column center">
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
    </section> -->
  </template>
  
  <script>
  import axios from 'axios';
  
  export default {
    data() {
      return {
        address: '',
        map: null,
        geocoder: null,
      };
    },
    mounted() {
      this.locatorButtonPressed(); // Automatically fetch address when component mounts
    },
    methods: {
      locatorButtonPressed() {
        if (navigator.geolocation) {
          navigator.geolocation.getCurrentPosition(
            (position) => {
              this.getAddressFrom(position.coords.latitude, position.coords.longitude);
            },
            (error) => {
              console.log(error.message);
            }
          );
        } else {
          alert('Geolocation is not supported by this browser.');
        }
      },
      getAddressFrom(lat, long) {
        axios
          .get(`https://nominatim.openstreetmap.org/reverse?format=json&lat=${lat}&lon=${long}`)
          .then((response) => {
            if (response.data.error) {
              console.log(response.data.error);
            } else {
              this.address = response.data.display_name;
              this.$emit('address-updated', this.address); // Emit the address to parent component
            }
          })
          .catch((error) => {
            console.log(error.message);
          });
      },
      go() {
        console.log(this.address);
        // Add logic to handle the 'Go' button click
      },
    },
  };
  </script>
  
  <style>
  #map {
    height: 400px;
  }
  </style>
  
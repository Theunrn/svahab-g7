<!-- frontend/src/Components/Maps/MapCom.vue -->
 
<template>
  <div>
    <div class="flex justify-between space-x-4 mb-2">
      <div class="desc">
        <div class="spend_time"><strong>Travel Time: </strong>{{ travelTime }}</div>
        <div class="distance"><strong>Distance: </strong>{{ travelDistance }}</div>
      </div>
    </div>
    <div id="map" class="h-screen"></div>
  </div>
</template>

<script>

export default {
  props: {
    address: String, // Destination address
    location: Object, // Current location { lat: Number, lng: Number }
  },
  data() {
    return {
      map: null,
      directionsService: null,
      directionsRenderer: null,
      travelTime: '',
      travelDistance: '',
    };
  },
  mounted() {
    // Initialize the map when the component is mounted
    this.initMap();
  },
  methods: {
    initMap() {
      // Create a map centered at the current location
      this.map = new google.maps.Map(document.getElementById('map'), {
        center: this.location,
        zoom: 14,
      });

      // Create DirectionsService and DirectionsRenderer instances
      this.directionsService = new google.maps.DirectionsService();
      this.directionsRenderer = new google.maps.DirectionsRenderer();
      this.directionsRenderer.setMap(this.map);

      // Calculate and display the route if both location and address are provided
      if (this.location && this.address) {
        this.calculateAndDisplayRoute();
      }
    },
    calculateAndDisplayRoute() {
      // Create a request object for the directions service
      const request = {
        origin: this.location,
        destination: this.address,
        travelMode: 'DRIVING',
      };

      // Route the request and set the directions on the map
      this.directionsService.route(request, (result, status) => {
        if (status === 'OK') {
          this.directionsRenderer.setDirections(result);
          const route = result.routes[0].legs[0];
          this.travelTime = route.duration.text;
          this.travelDistance = route.distance.text;
        } else {
          console.error('Directions request failed due to ' + status);
        }
      });
    },
  },
  watch: {
    // Watch for changes in location and address to recalculate the route
    location(newVal) {
      if (newVal && this.address) {
        this.calculateAndDisplayRoute();
      }
    },
    address(newVal) {
      if (newVal && this.location) {
        this.calculateAndDisplayRoute();
      }
    },
  },
};

</script>


<style scoped>
#map {
    width: 100%;
    height: 80vh;
  }
</style>
  
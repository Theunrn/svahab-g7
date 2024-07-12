<template>
  <div>
    <div class="flex justify-between space-x-4 mb-2">
      <div class="desc">
        <div class="spend_time "><strong>Travel Time: </strong>{{ travelTime }}</div>
        <div class="distance"> <strong>Distance: </strong>{{ travelDistance }}</div>
      </div>
      <button @click="calcRoute" class="bg-blue-500 text-white px-3 py-1 rounded"><i class='bx bxs-direction-right text-3xl'></i></button>
    </div>
    
    <div id="map" class="h-screen"></div>
  </div>
</template>
<script>
export default {
  props:{
    address:String,
    location:String,
  },
  data() {
    return {
      map: null,
      directionsService: null,
      directionsRenderer: null,
      sourceAutocomplete: null,
      desAutocomplete: null,
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
      this.map = new google.maps.Map(document.getElementById('map'), {
        center: { lat: 12.5657, lng: 104.9910 }, // Centering the map on Cambodia
        zoom: 7.5
      });

      google.maps.event.addListener(this.map, "click", () => {
        this.map.setOptions({ scrollwheel: true });
      });

      this.directionsService = new google.maps.DirectionsService();
      this.directionsRenderer = new google.maps.DirectionsRenderer();
      this.directionsRenderer.setMap(this.map);

      this.sourceAutocomplete = new google.maps.places.Autocomplete(
        document.getElementById('source')
      );

      this.desAutocomplete = new google.maps.places.Autocomplete(
        document.getElementById('dest')
      );
    },
    calcRoute() {
      const source = this.location;
      const dest = this.address;

      let request = {
        origin: source,
        destination: dest,
        travelMode: "DRIVING"
      };

      this.directionsService.route(request, (result, status) => {
        if (status === "OK") {
          this.directionsRenderer.setDirections(result);
          
          const route = result.routes[0].legs[0];
          this.travelTime = ` ${route.duration.text}`;
          this.travelDistance = `${route.distance.text}`;
        } else {
          console.error('Directions request failed due to ' + status);
        }
      });
    }
  }
};
</script>

  <style scoped>
  #map {
    width: 100%;
    height: 80vh;
  }
  </style>
  
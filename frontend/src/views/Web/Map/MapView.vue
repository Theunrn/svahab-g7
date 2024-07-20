<!-- frontend/src/views/Web/Map/MapView.vue -->
<template>
    <div>
      <h2>Map View</h2>
      <MapCom :address="receivedAddress"></MapCom> <!-- Pass receivedAddress as prop to MapCom -->
      <CurrentMap @address-updated="handleAddressUpdate"></CurrentMap> <!-- Listen for address-updated event -->
    </div>
  </template>
  
  <script setup lang="ts">
  import MapCom from '../../../Components/Maps/MapCom.vue';
  import CurrentMap from '../../../Components/Maps/CurrentUser.vue';
  
  // Define reactive state
  import { ref } from 'vue';
  const receivedAddress = ref<string>(''); // Reactive reference for received address
  
  // Event handler for address-updated event
  const handleAddressUpdate = (address: string) => {
    receivedAddress.value = address;
  };
  </script>
  
  <style scoped>
  </style>
  
<template>
  <WebHeaderMenu></WebHeaderMenu>
  <HeaderShop></HeaderShop>
  <CardShop :user="authStore.user"></CardShop>
  <WebFooter></WebFooter>
</template>
  
<script setup lang="ts">
  // Import your custom store
  import { useAuthStore } from '../../../src/stores/auth-store'
  import WebHeaderMenu from '../../Components/WebHeaderMenu.vue'
  import WebFooter from '../../Components/WebFooter.vue'
  import HeaderShop from '../../Components/Shops/HeaderShop.vue'
  import CardShop from '../../Components/Shops/CardShop.vue'
  const authStore = useAuthStore()
</script>
  
    
  
<style scoped>
  html,
  body {
    margin: 0;
    padding: 0;
    width: 100%;
    height: 100%;
  }
</style>
  
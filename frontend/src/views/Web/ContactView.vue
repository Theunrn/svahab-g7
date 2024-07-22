<template>
  <WebHeaderMenu></WebHeaderMenu>
  <ContactUse/>
  <WebFooter></WebFooter>
</template>
  
<script setup lang="ts">
  // Import components
  import WebHeaderMenu from '@/Components/WebHeaderMenu.vue'
  import ContactUse from '@/Components/Contact/ContactUse.vue'
  import WebFooter from '../../Components/WebFooter.vue'

</script>
  
<style scoped>
  html, body {
    margin: 0;
    padding: 0;
    width: 100%;
    height: 100%;
  } 
</style>
  
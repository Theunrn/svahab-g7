<template>
  <WebLayout></WebLayout>
  <SearchView></SearchView>
 <div class="div flex justify-content-center mt-3">
    <img width="18%" height="18%" src="../../assets/image/logo1.png" alt="">
  </div>
 <CardCom></CardCom>
 <WeatherCom></WeatherCom>
 <WebFooter></WebFooter>

</template>

<script setup lang="ts">
import WebLayout from '@/Components/Layouts/WebLayout.vue'
import SearchView from '../../views/Web/SearchBar/SearchView.vue'
import CardCom from '../../Components/Cards/CardCom.vue'
import WebFooter from '../../Components/WebFooter.vue'
import WeatherCom from '../../Components/Weathers/WeatherCom.vue'
</script>

<style scoped>
html, body {
  margin: 0;
  padding: 0;
  width: 100%;
  height: 100%;
}
</style>

<template>
  <WebLayout></WebLayout>
 <div class="div flex justify-content-center mt-3 relative z-10">
    <img width="18%" height="18%" src="../../assets/image/logo1.png" alt="">
  </div>
 <CardCom :user="authStore.user"></CardCom>
 <MatchTeam></MatchTeam>

 <MatchSchedule></MatchSchedule>
 <WeatherCom></WeatherCom>
 <WebFooter></WebFooter>

</template>

<script setup lang="ts">
import { useAuthStore } from '../../../src/stores/auth-store';
import WebLayout from '@/Components/Layouts/WebLayout.vue'
import CardCom from '../../Components/Cards/CardCom.vue'
import WebFooter from '../../Components/WebFooter.vue'
import WeatherCom from '../../Components/Weathers/WeatherCom.vue'
import MatchTeam from '../../Components/Bodies/MatchTeam.vue'
import MatchSchedule from '../../Components/Bodies/MatchSchedule.vue'
const authStore = useAuthStore();
</script>

<style scoped>
html, body {
  margin: 0;
  padding: 0;
  width: 100%;
  height: 100%;
}
</style>

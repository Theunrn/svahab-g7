<template>
  <WebLayout :customer="authStore.user"></WebLayout>
 <CardCom :customer="authStore.user"></CardCom>
 <MatchTeam :customer="authStore.user"></MatchTeam>

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

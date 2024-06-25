<template>
    <HeaderAbout></HeaderAbout>
    <CardService></CardService>
    <MvvAbout></MvvAbout>
    <RateAbout></RateAbout>
    <FeedAbout></FeedAbout>
   <WebFooter></WebFooter>
  
  </template>
  
  <script setup lang="ts">
  import HeaderAbout from '@/Components/AboutPage/HeaderAbout.vue';
  import CardService from '@/Components/AboutPage/CardService.vue';
  import MvvAbout from '@/Components/AboutPage/MvvAbout.vue';
  import RateAbout from '@/Components/AboutPage/RateAbout.vue';
  import FeedAbout from '@/Components/AboutPage/FeedAbout.vue';
  import WebFooter from '../../Components/WebFooter.vue';

  </script>
  
  <style scoped>
  html, body {
    margin: 0;
    padding: 0;
    width: 100%;
    height: 100%;
  }
  </style>
  
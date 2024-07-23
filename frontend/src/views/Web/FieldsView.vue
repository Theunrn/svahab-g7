<template>
  <WebHeaderMenu></WebHeaderMenu>
  <!-- search field -->
  <div class='max-w-md mx-auto mt-10'>
    <div class="relative flex items-center w-full h-12 rounded-lg focus-within:shadow-lg bg-white overflow-hidden">
        <div class="grid place-items-center h-full w-12 text-gray-300">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
            </svg>
        </div>

        <input
        class="peer h-full w-full outline-none text-sm text-gray-700 pr-2"
        type="text"
        id="search"
        placeholder="Search fields..." /> 
    </div>
</div>
  <CardCom />
  <WebFooter></WebFooter>
</template>
  
<script setup lang="ts">
  // import necessary components here
  import WebHeaderMenu from '@/Components/WebHeaderMenu (3).vue'
  import WebFooter from '../../Components/WebFooter.vue'
  import CardCom from '../../Components/Cards/CardField.vue'
</script>

<style scoped>
  html,
  body {
    margin: 0;
    padding: 0;
    width: 100%;
    height: 100%;
  }

  .search-container {
    position: relative;
    width: 100%;
  }

  .search-container input {
    padding: 10px;
    font-size: 17px;
    border: 1px solid #ddd;
  }
</style>
  
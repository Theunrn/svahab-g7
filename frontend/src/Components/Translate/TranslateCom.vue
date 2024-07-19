<template>
    <div>
      <button @click="changeLanguage('km')">Khmer</button>
      <button @click="changeLanguage('en')">English</button>
      <p>{{ translatedText }}</p>
    </div>
  </template>
  
  <script setup lang="ts">
  import { ref } from 'vue';
  import { translateText } from '../../services/translationService';
  
  const textToTranslate = 'Hello, how are you?'; // Example text
  const translatedText = ref(textToTranslate);
  const currentLang = ref('en');
  
  const changeLanguage = async (lang: string) => {
    try {
      currentLang.value = lang;
      translatedText.value = await translateText(textToTranslate, lang);
    } catch (error) {
      console.error('Error translating text:', error);
    }
  };
  </script>
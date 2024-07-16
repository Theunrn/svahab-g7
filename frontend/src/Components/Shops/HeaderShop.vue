<template>
  <div
    style="margin-top: 80px"
    id="default-carousel"
    class="relative w-full"
    data-carousel="slide"
    @mouseenter="stopAutoSlide"
    @mouseleave="startAutoSlide"
  >
    <!-- Carousel wrapper -->
    <div class="relative h-86 overflow-hidden rounded-lg md:h-96">
      <!-- Carousel items -->
      <div
        v-for="(slide, index) in slides"
        :key="index"
        :class="[
          'absolute inset-0 duration-500 ease-in-out transform',
          { block: activeIndex === index, hidden: activeIndex !== index }
        ]"
      >
        <img :src="getImageUrl(slide.image)" class="absolute block w-full h-full object-cover" alt="..." />
      </div>
    </div>

    <!-- Slider indicators -->
    <div
      class="absolute z-30 flex -translate-x-1/2 bottom-5 left-1/2 space-x-3 rtl:space-x-reverse"
    >
      <button
        v-for="(slide, index) in slides"
        :key="index"
        type="button"
        :class="[
          'w-3 h-3 rounded-full',
          { 'bg-gray-800': activeIndex === index, 'bg-gray-300': activeIndex !== index }
        ]"
        aria-current="true"
        :aria-label="`Slide ${index + 1}`"
        @click="setActiveSlide(index)"
        :data-carousel-slide-to="index"
      ></button>
    </div>

    <!-- Slider controls -->
    <button
      type="button"
      class="absolute top-0 left-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none"
      @click="prevSlide"
      data-carousel-prev
    >
      <span
        class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none"
      >

      
        <svg
          class="w-4 h-4 text-white dark:text-gray-800 rtl:rotate-180"
          aria-hidden="true"
          xmlns="http://www.w3.org/2000/svg"
          fill="none"
          viewBox="0 0 6 10"
        >
          <path
            stroke="currentColor"
            stroke-linecap="round"
            stroke-linejoin="round"
            stroke-width="2"
            d="M5 1 1 5l4 4"
          />
        </svg>
        <span class="sr-only">Previous</span>
      </span>
    </button>

    <button
      type="button"
      class="absolute top-0 right-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none"
      @click="nextSlide"
      data-carousel-next
    >
      <span
        class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none"
      >
        <svg
          class="w-4 h-4 text-white dark:text-gray-800 rtl:rotate-180"
          aria-hidden="true"
          xmlns="http://www.w3.org/2000/svg"
          fill="none"
          viewBox="0 0 6 10"
        >
          <path
            stroke="currentColor"
            stroke-linecap="round"
            stroke-linejoin="round"
            stroke-width="2"
            d="m1 9 4-4-4-4"
          />
        </svg>
        <span class="sr-only">Next</span>
      </span>
    </button>
  </div>
</template>

<script>
import axiosInstance from '@/plugins/axios'

export default {
  data() {
    return {
      activeIndex: 0,
      slides: [],
      autoSlideInterval: null,
      autoSlideDelay: 5000 // Adjust auto slide delay in milliseconds (e.g., 5000 = 5 seconds)
    }
  },
  mounted() {
    this.fetchSlideshows() // Fetch the slideshow data when the component is mounted
    this.startAutoSlide() // Start auto sliding when component is mounted
  },
  methods: {
    async fetchSlideshows() {
      try {
        const response = await axiosInstance.get('slideshow/list')

        console.log(response.data) // Log the API response for debugging
        if (response.data) {
          this.slides = response.data// Ensure the correct property is assigned
          console.log(this.slides) // Log the API response for debugging
        } else {
          console.error('Failed to fetch slideshows: ', response.data.message)
        }
        console.log(this.slides) // Log the API response for debugging

      } catch (error) {
        console.error('Error fetching slideshows:', error)
      }
    },
    setActiveSlide(index) {
      this.activeIndex = index
    },
    prevSlide() {
      this.activeIndex = (this.activeIndex - 1 + this.slides.length) % this.slides.length
    },
    nextSlide() {
      this.activeIndex = (this.activeIndex + 1) % this.slides.length
    },
    startAutoSlide() {
      this.autoSlideInterval = setInterval(() => {
        this.nextSlide()
      }, this.autoSlideDelay)
    },
    stopAutoSlide() {
      clearInterval(this.autoSlideInterval) // Stop auto sliding when hovering over the carousel
    },
    getImageUrl(imagePath) {
      return `http://127.0.0.1:8000/storage/${imagePath}`; // Adjust URL if needed
    },
  }
}
</script>

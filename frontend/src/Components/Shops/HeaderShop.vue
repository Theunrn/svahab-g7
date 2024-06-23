<template>
  <div style="margin-top: 80px;" id="default-carousel" class="relative w-full" data-carousel="slide" @mouseenter="stopAutoSlide" @mouseleave="startAutoSlide">
    <!-- Carousel wrapper -->
    <div class="relative h-86 overflow-hidden rounded-lg md:h-96">
      <!-- Carousel items -->
      <div v-for="(slide, index) in slides" :key="index"
           :class="['absolute inset-0 duration-500 ease-in-out transform', { 'block': activeIndex === index, 'hidden': activeIndex !== index }]">
        <img :src="slide.imageUrl" class="absolute block w-full h-full object-cover" alt="...">
      </div>
    </div>
    
    <!-- Slider indicators -->
    <div class="absolute z-30 flex -translate-x-1/2 bottom-5 left-1/2 space-x-3 rtl:space-x-reverse">
      <button v-for="(slide, index) in slides"
              :key="index"
              type="button"
              :class="['w-3 h-3 rounded-full', { 'bg-gray-800': activeIndex === index, 'bg-gray-300': activeIndex !== index }]"
              aria-current="true"
              :aria-label="`Slide ${index + 1}`"
              @click="setActiveSlide(index)"
              :data-carousel-slide-to="index">
      </button>
    </div>
    
    <!-- Slider controls -->
    <button type="button"
            class="absolute top-0 left-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none"
            @click="prevSlide"
            data-carousel-prev>
      <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
        <svg class="w-4 h-4 text-white dark:text-gray-800 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
          <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 1 1 5l4 4"/>
        </svg>
        <span class="sr-only">Previous</span>
      </span>
    </button>
    
    <button type="button"
            class="absolute top-0 right-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none"
            @click="nextSlide"
            data-carousel-next>
      <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
        <svg class="w-4 h-4 text-white dark:text-gray-800 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
          <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
        </svg>
        <span class="sr-only">Next</span>
      </span>
    </button>
  </div>
</template>

<script>
export default {
  data() {
    return {
      activeIndex: 0,
      slides: [
        { imageUrl: 'https://static.toiimg.com/thumb/msid-90590952,width-1280,resizemode-4/90590952.jpg' },
        { imageUrl: 'https://themodestlifestyle.com/wp-content/uploads/2022/02/sport-cover-photo.jpg' },
        { imageUrl: 'https://www.zellamsee-kaprun.com/bilder/shopping/premium-shopping/7659/image-thumb__7659__auto_50aa5baf05281f6b6988b9abf8a8824f/intersport-scholz-129--c-johannesradlwimmer.jpg' },
        { imageUrl: 'https://us.123rf.com/450wm/jackf/jackf1712/jackf171204021/92762704-image-of-new-equipment-for-skiing-on-showcase-of-store.jpg?ver=6' },
        { imageUrl: 'https://media.istockphoto.com/id/1346402981/photo/shopping-outdoor-equipment.jpg?s=612x612&w=0&k=20&c=pC_K35iIywzlm4Nrlz39-s_rdJPvbuK099Hvbc3CZBk=' }
      ],
      autoSlideInterval: null,
      autoSlideDelay: 5000 // Adjust auto slide delay in milliseconds (e.g., 5000 = 5 seconds)
    };
  },
  mounted() {
    this.startAutoSlide(); // Start auto sliding when component is mounted
  },
  methods: {
    setActiveSlide(index) {
      this.activeIndex = index;
    },
    prevSlide() {
      this.activeIndex = (this.activeIndex - 1 + this.slides.length) % this.slides.length;
    },
    nextSlide() {
      this.activeIndex = (this.activeIndex + 1) % this.slides.length;
    },
    startAutoSlide() {
      this.autoSlideInterval = setInterval(() => {
        this.nextSlide();
      }, this.autoSlideDelay);
    },
    stopAutoSlide() {
      clearInterval(this.autoSlideInterval); // Stop auto sliding when hovering over the carousel
    }
  }
};
</script>

<style scoped>
/* Scoped styles for the carousel */
.carousel-caption {
  position: absolute;
  top: 60%;
  left: 50%;
  transform: translate(-50%, -50%);
  text-align: center;
  color: #fff;
  background-color: rgba(0, 0, 0, 0.5);
  width: 100%;
  border-radius: 10px;
  font-size: 1.2rem;
  text-shadow: 0 0 10px #000;
}

.carousel-caption h1 {
  font-size: 4rem;
  font-weight: 600;
  text-shadow: 0 0 10px #000;
}
</style>

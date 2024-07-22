<template>
  <section class="bg-gray-100">
    <div class="w-90% mx-auto">
      <div class="mb-10 rounded overflow-hidden flex flex-col mx-auto">
        <div class="relative">
          <img class="w-full" src="../../assets/image/team.jpg" alt="Football field management" />
          <div class="absolute inset-0 bg-black bg-opacity-50">
            <div class="absolute inset-0 flex items-center justify-center">
              <div class="text-center">
                <h1 class="text-5xl text-white font-bold">
                  <span class="animate-typing border-r-4 border-r-white pr-3">Feedback...</span>
                </h1>
              </div>
            </div>
          </div>
          <div id="myCarousel" class="relative container mx-auto">
            <div class="overflow-hidden relative w-full -mt-70">
              <div
                class="flex transition-transform duration-500"
                :style="carouselStyle"
                @transitionend="handleTransitionEnd"
              >
                <div
                  v-for="(item, index) in duplicatedItems"
                  :key="index"
                  class="flex-shrink-0 w-full md:w-1/4"
                >
                  <div class="card card-body p-4">
                    <p class="text-content">{{ item.feedback }}</p>
                  </div>
                </div>
              </div>
            </div>
            <button
              class="absolute top-1/2 transform -translate-y-1/2 left-0 bg-gray-800 text-white p-2"
              @click="prevSlide"
            >
              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              <span class="sr-only">Previous</span>
            </button>
            <button
              class="absolute top-1/2 transform -translate-y-1/2 right-0 bg-gray-800 text-white p-2"
              @click="nextSlide"
            >
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="sr-only">Next</span>
            </button>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>

<script>
  export default {
    // ======================= Data =======================
    data() {
      return {
        currentIndex: 0, // Index of the current slide
        items: [
          { feedback: 'Great facilities and well-maintained fields. Highly recommended!' },
          { feedback: 'Convenient location and competitive pricing. Will come back again.' },
          { feedback: 'Professional staff and a friendly atmosphere. Perfect for our team.' },
          { feedback: 'Easy to find available slots and hassle-free booking experience.' },
          { feedback: 'Clean and spacious facilities. Great for both practice and games.' },
          { feedback: 'Responsive management and quick to address any issues. Impressed!' }
        ],
        slideInterval: null, // Interval ID for automatic sliding
        transitioning: false // Flag to control slide transition
      }
    },

    // ======================= Computed Properties =======================
    computed: {
      // Duplicate items to create a seamless infinite scroll effect
      duplicatedItems() {
        return [...this.items, ...this.items]
      },
      // Style for the carousel container with dynamic translation
      carouselStyle() {
        return {
          transform: `translateX(-${(this.currentIndex % this.items.length) * 100}%)`,
          transition: this.transitioning ? 'transform 0.5s' : 'none'
        }
      }
    },

    // ======================= Lifecycle Hooks =======================
    mounted() {
      this.startAutoSlide() // Start auto-slide when the component is mounted
    },

    // ======================= Methods =======================
    methods: {
      // Start automatic sliding with an interval
      startAutoSlide() {
        this.slideInterval = setInterval(this.nextSlide, 5000) // Change slide every 5 seconds
      },
      // Stop automatic sliding by clearing the interval
      stopAutoSlide() {
        clearInterval(this.slideInterval)
      },
      // Go to the previous slide
      prevSlide() {
        this.stopAutoSlide()
        this.transitioning = true
        this.currentIndex = this.currentIndex === 0 ? this.items.length - 1 : this.currentIndex - 1
        this.startAutoSlide()
      },
      // Go to the next slide
      nextSlide() {
        this.stopAutoSlide()
        this.transitioning = true
        this.currentIndex = (this.currentIndex + 1) % this.items.length
        this.startAutoSlide()
      },
      // Handle the end of the slide transition
      handleTransitionEnd() {
        if (this.currentIndex >= this.items.length) {
          this.transitioning = false
          this.currentIndex = 0
        }
        if (this.currentIndex < 0) {
          this.transitioning = false
          this.currentIndex = this.items.length - 1
        }
      }
    },

    // ======================= Lifecycle Hooks =======================
    beforeDestroy() {
      this.stopAutoSlide() // Clean up the interval before the component is destroyed
    }
  }

</script>

<style scoped>
  /* Additional styling can go here if needed */
  .text-content {
    font-size: 1.25rem;
    color: #333;
    text-align: center;
  }

  @keyframes typing {
    from {
      width: 0;
    }
    to {
      width: 100%;
    }
  }

  .animate-typing {
    display: inline-block;
    animation: typing 2s steps(20, end) infinite;
    white-space: nowrap;
    overflow: hidden;
    border-right: 4px solid transparent;
  }
</style>

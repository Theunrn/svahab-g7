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
        const response = await axiosInstance.get('/slideshow/list')
        console.log('API response:', response.data) // Log the API response for debugging
        this.slides = response.data.map((slide) => ({ imageUrl: slide.imageUrl }))
        console.log('Slides:', this.slides) // Log the slides data for debugging
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
    }
  }
}
</script>

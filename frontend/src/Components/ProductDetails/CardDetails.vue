<template>
  <div class="product-detail my-5">
    <div class="row mb-3">
      <div class="col-12">
        <router-link to="/product" class="btn btn-outline-primary"> Back </router-link>
      </div>
    </div>
    <div class="row" style="margin-left: -50px">
      <!-- Image Section -->
      <div class="col-md-6">
        <div class="product-images">
          <img :src="getImageUrl(product.image)" class="img-fluid" :alt="product.name" />
        </div>
      </div>
      <!-- Product Details Section -->
      <div class="col-md-6">
        <h2 class="mb-2 mt-4 fs-3 font-bold">{{ product.name }}</h2>
        <h3 class="mb-2">{{ product.description }}</h3>
        <p class="mb-1"><strong>Call: </strong> 098753527</p>
        <p class="price text-success font-weight-bold mb-2">
          <strong>Price: </strong> ${{ product.price }}
        </p>
        <p class="mb-2">Tax included</p>
        <div class="rating mb-2">
          <span class="star text-warning">&#9733;</span>
          <span class="star text-warning">&#9733;</span>
          <span class="star text-warning">&#9733;</span>
          <span class="star text-warning">&#9733;</span>
          <span class="star text-warning">&#9733;</span>
          <span>(1053 reviews)</span>
        </div>
        <div class="color-options mb-3">
          <h5 class="mb-2">Color:</h5>
          <div class="d-flex flex-wrap">
            <div
              v-for="color in colors"
              :key="color.id"
              :style="{ backgroundColor: color.hex_code }"
              :class="[
                'color-circle',
                'mr-2',
                'cursor-pointer',
                `bg-${color.name.toLowerCase()}`,
                { selected: selectedColor === color.id }
              ]"
              @click="toggleColorSelection(color.id)"
            ></div>
          </div>
        </div>
        <div class="size-options mb-3">
          <h5 class="mb-2">Size:</h5>
          <select class="form-select w-auto" v-model="selectedSize">
            <option v-for="size in sizes" :key="size.id" :value="size.id">{{ size.name }}</option>
          </select>
        </div>
        <div class="quantity mb-4">
          <h5 class="mb-2">Quantity:</h5>
          <div class="input-group w-auto">
            <div class="quantity-input">
              <button @click="decrementQuantity" class="decrement btn btn-outline-secondary">
                -
              </button>
              <input class="input-group min-max" type="text" v-model.number="quantity" />
              <button @click="incrementQuantity" class="increment btn btn-outline-secondary">
                +
              </button>
            </div>
          </div>
        </div>
        <router-link to="/payment" class="btn btn-warning btn-block mb-4"> Pay Now</router-link>
        <div class="delivery-info mb-4">
          <p class="mb-1"><strong>Home Delivery:</strong> Available within 48 hours</p>
          <p class="mb-0"><strong>Click & Collect:</strong> Pickup in store within 4 hours</p>
        </div>
        <div class="product-description">
          <p>
            Our product designers, themselves football players, designed the Sunny 300 mini ball for
            kids starting to dribble, shoot, or juggle with their hands or feet.
          </p>
          <p class="mb-0">
            Looking for a ball to learn the basics of football? This mini plastic football is
            perfect. Plus, it's ideal for playing barefoot.
          </p>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup lang="ts">
import { useRoute } from 'vue-router'
import { ref, computed, onMounted } from 'vue'
import axiosInstance from '@/plugins/axios'

const route = useRoute()
const productId = computed(() => route.params)
const product = ref({})
const colors = ref([]) // Reactive reference for colors
const selectedColor = ref(null) // Reactive reference for selected color
const sizes = ref([]) // Reactive reference for sizes
const selectedSize = ref(null) // Reactive reference for selected size
const quantity = ref(1) // Reactive reference for quantity

const fetchProductDetails = async () => {
  try {
    const response = await axiosInstance.get(`/product/show/${productId.value.id}`)
    product.value = response.data.data
  } catch (error) {
    console.error('Error fetching product details:', error)
  }
}

const fetchSizes = async () => {
  try {
    const response = await axiosInstance.get('/sizes')
    sizes.value = response.data.data
  } catch (error) {
    console.error('Error fetching sizes:', error)
  }
}

const fetchColors = async () => {
  try {
    const response = await axiosInstance.get('/colors')
    colors.value = response.data.data
  } catch (error) {
    console.error('Error fetching colors:', error)
  }
}

onMounted(() => {
  fetchProductDetails()
  fetchColors()
  fetchSizes()
})

const getImageUrl = (imagePath) => {
  return imagePath ? `http://127.0.0.1:8000/storage/${imagePath}` : '/default-image.jpg'
}

const incrementQuantity = () => {
  quantity.value++
}

const decrementQuantity = () => {
  if (quantity.value > 1) {
    quantity.value--
  }
}

const toggleColorSelection = (colorId: number) => {
  selectedColor.value = colorId
}
</script>

<style scoped>
.product-detail {
  color: #000;
  max-width: 900px;
  margin: 20px auto;
}

.price {
  font-size: 1.5em;
}

.rating .star {
  font-size: 1.2em;
}

.color-options .color-circle {
  width: 30px;
  height: 30px;
  border-radius: 50%;
  border: 1px solid #ddd;
  cursor: pointer;
}

.color-options .color-circle.selected {
  border: 2px solid #000;
}

.bg-red {
  background-color: red;
}

.bg-black {
  background-color: black;
}

.bg-white {
  background-color: white;
}

.bg-pink {
  background-color: pink;
}

.bg-yellow {
  background-color: yellow;
}

.bg-blue {
  background-color: blue;
}

.btn {
  background-color: #fff;
  color: #000;
  text-decoration: none;
  cursor: pointer;
  transition: all 0.3s ease-in-out;
  outline: none;
  border: none;
  box-shadow: 0px 0px 10px 0px rgba(0, 0, 0, 0.2);
  position: relative;
}

.quantity-input {
  display: inline-flex;
  align-items: center;
  border: 1px solid #ccc;
  border-radius: 4px;
  padding: 5px;
}

.quantity-input button {
  width: 30px;
  height: 30px;
  font-size: 18px;
  background-color: #f2f2f2;
  border: none;
  cursor: pointer;
}

.quantity-input input {
  width: 50px;
  height: 30px;
  text-align: center;
  border: none;
  margin: 0 10px;
}

.cursor-pointer {
  cursor: pointer;
}
</style>

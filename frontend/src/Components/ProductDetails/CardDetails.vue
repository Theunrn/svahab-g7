<template>
  <div class="product-detail my-5">
    <div class="button-row row mb-3">
      <div class="col-12">
        <router-link to="/product" class="btn btn-outline-primary"> Back </router-link>
      </div>
    </div>
    <div class="product-row row " style="margin-left: -50px">
      <!-- Image Section -->
      <div class="img-section col-md-6">
        <!-- <div class="product-images mt-5">
          <img :src="getImageUrl(product.image)" class="img-fluid" :alt="product.name" />
        </div> -->
        <div class="product-images mt-4" ref="imageContainer">
          <img :src="getImageUrl(product.image)" class="img-fluid" :alt="product.name" @mousemove="zoomImage" @mouseleave="resetZoom" />
          <div class="zoomed-image" v-show="zoomedIn" :style="{ backgroundImage: 'url(' + getImageUrl(product.image) + ')', backgroundSize: zoomScale }"></div>
        </div>
      </div>
      <!-- Product Details Section -->
      <div class="product-section-detail col-md-6">
        <div class="section-information">
          <h2 class="mb-2 mt-4 fs-3 font-bold">{{ product.name }}</h2>
          <h3 class="mb-2">{{ product.description }}</h3>
          <p class="mb-1"><strong>Call: </strong> 098753527</p>
          <div class="flex gap-3">
            <p class="price text-danger font-weight-bold mb-2" :class="{ 'text-decoration-line-through': product.discounts && product.discounts.length > 0 }" >
              <strong>Price: </strong> ${{ product.price }}
            </p>
            <p class="price text-success font-weight-bold mb-2" v-if="product.discounts && product.discounts.length > 0" > ${{ calculateDiscountedPrice(product.price, product.discounts[0].discount) }}
            </p>
          </div>
          <p class="bg-white text-gray-700 border-2 border-green-300 rounded-md py-2 px-4 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent w-40" >
            <span>Total: </span> ${{ total }}
          </p>
          <div class="rating mb-2">
            <span class="star text-warning">&#9733;</span>
            <span class="star text-warning">&#9733;</span>
            <span class="star text-warning">&#9733;</span>
            <span class="star text-warning">&#9733;</span>
            <span class="star text-warning">&#9733;</span>
            <span>(1053 reviews)</span>
          </div>
        </div>
        <div class="section-detail">
          <div class="color-options mb-3">
            <h5 class="mb-2">Color:</h5>
            <div class="d-flex flex-wrap">
              <div v-for="color in product.colors" :key="color.id" :style="{ backgroundColor: color.hex_code }" :class="[  'color-circle', 'mr-2', 'cursor-pointer', `bg-${color.name.toLowerCase()}`, { selected: selectedColor === color.id }  ]"  @click="toggleColorSelection(color.id)" ></div>
            </div>
          </div>
          <div class="size-options mb-3 flex gap-3">
            <div class="size">
              <h5 class="mb-2">Size:</h5>
              <select class="form-select w-auto pe-5" v-model="selectedSize">
                <option class="text-start" v-for="size in product.sizes" :key="size.id"  :value="size.id" >
                  {{ size.name }}
                </option>
              </select>
            </div>
            <div class="way">
              <h5 class="mb-2">The way:</h5>
              <select class="form-select w-auto">
                <option value="pickup">Pickup</option>
                <option value="delivery">Delivery (+2$)</option>
              </select>
            </div>
          </div>
          <div class="quantity mb-4">
            <h5 class="mb-2">Quantity:</h5>
            <div class="input-group w-auto">
              <div class="quantity-input">
               <button @click="decrementQuantity" class="decrement btn btn-outline-secondary">  -  </button>
                <input class="input-group min-max" type="text" v-model="quantity" />
                <button @click="incrementQuantity" class="increment btn btn-outline-secondary">  +  </button>
              </div>
            </div>
          </div>
          <!-- <a @click="createOrder" class="btn btn-warning btn-block mb-4"> Order Now</a> -->
          <router-link  @click="submitOrder"  :to="{ path: '/payment/' + userId, query: { order: order.id } }"  class="btn btn-yellow-500 btn-block ml-4 mb-4 text-white"  style="background-color: orange"  >  Pay Now</router-link >
          <div class="delivery-info mb-4">
            <p class="mb-1"><strong>Home Delivery:</strong> Available within 48 hours</p>
            <p class="mb-0"><strong>Click & Collect:</strong> Pickup in store within 4 hours</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup lang="ts">
import { ref, computed, onMounted } from 'vue'
import axiosInstance from '@/plugins/axios'
import { useRoute, useRouter } from 'vue-router'
import Swal from 'sweetalert2'
// import ImageZoomer from 'vue-image-zoomer'

const route = useRoute()
const router = useRouter()
const productId = computed(() => route.params)
const product = ref({})
const colors = ref([]) // Reactive reference for colors
const selectedColor = ref(null) // Reactive reference for selected color
const sizes = ref([]) // Reactive reference for sizes
const selectedSize = ref(null) // Reactive reference for selected size
const quantity = ref(1)
const order = ref({})
const userId = computed(() => route.query.customer)
const discountPrice = ref(0)
const zoomedIn = ref(false)
const zoomScale = ref('100%')

const fetchProductDetails = async () => {
  try {
    const response = await axiosInstance.get(`/product/show/${productId.value.id}`)
    product.value = response.data.data
    product.discounts = product.value.discounts || [] // Initialize discounts
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

const total = computed(() => {
  if (discountPrice.value) {
    return (discountPrice.value * quantity.value).toFixed(2)
  }
  return (product.value.price * quantity.value).toFixed(2)
})

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

const toggleColorSelection = (colorId) => {
  selectedColor.value = colorId
}

const calculateDiscountedPrice = (originalPrice, discountPercentage) => {
  const discount = (originalPrice * discountPercentage) / 100
  discountPrice.value = originalPrice - discount
  return originalPrice - discount
}

const zoomImage = (event) => {
  const { offsetWidth, offsetHeight, naturalWidth, naturalHeight } = event.target
  const { offsetX, offsetY } = event
  const scaleX = naturalWidth / offsetWidth
  const scaleY = naturalHeight / offsetHeight
  zoomScale.value = `${scaleX * 100}%`
  zoomedIn.value = true
}

const resetZoom = () => {
  zoomedIn.value = false
}

const submitOrder = async () => {
  try {
    const response = await axiosInstance.post('/orders/create', {
      product_id: productId.value.id,
      color_id: selectedColor.value,
      size_id: selectedSize.value,
      qty: quantity.value,
      total_amount: total.value
    })

    order.value = response.data.order
    const orderId = order.value.id
    localStorage.setItem('orderId', orderId)
    Swal.fire({
      position: 'center',
      icon: 'success',
      // title: 'Your order has been created successfully',
      html: `<span style="font-size: 26px; font-weight: bold;">Your order has been created successfully</span>`,
      showConfirmButton: false,
      timer: 1000
    })
  } catch (error) {
    console.error('Error creating order:', error)
  }
}
</script>

<style scoped>
.product-detail {
  color: #000;
  max-width: 900px;
  margin: 20px auto;
}

.product-images {
  position: relative;
  overflow: hidden;
}

.zoomed-image {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-repeat: no-repeat;
  background-position: center;
  background-color: rgba(255, 255, 255, 0.9);
  z-index: 10;
  display: none;
}

.price {
  font-size: 1.5em;
}

.rating .star {
  font-size: 1.2em;
}

.text-decoration-line-through {
  text-decoration: line-through;
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

@media (min-width: 481px) and (max-width: 768px) {
  .product-row {
    display: flex;
    justify-content: center;
    align-items: center;
    flex-direction: column;
  }

  .product-images {
    order: 1;
  }

  .order-details {
    order: 2;
  }

  .button-row {
    margin-top: 80px;
    margin-left: 30px;
  }

  .img-section {
    display: flex;
    justify-content: center;
    align-items: center;
    margin-right: 10px;
  }

  .product-section-detail {
    margin-left: 70px;
    display: flex;
    justify-content: space-between;
  }

  .section-information {
    margin-left: 70px;
  }

  .section-detail {
    flex-direction: column;
    margin-right: 100px;
    margin-top: 30px;
  }
}

</style>

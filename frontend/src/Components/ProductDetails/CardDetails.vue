<template>
  <div class="product-detail my-5">
    <!-- Other code remains the same -->
    <div class="row mb-3">
      <div class="col-12">
        <router-link to="/product" class="btn btn-outline-primary"> Back </router-link>
      </div>
    </div>
    <div v-for="(product, index) in orderProducts" :key="index" class="row" style="margin-left: -50px">
      <!-- Image Section -->
      <div class="col-md-6">
        <div class="product-images mt-5">
          <img :src="getImageUrl(product.image)" class="img-fluid" :alt="product.name" />
        </div>
      </div>
      <!-- Product Details Section -->
      <div class="col-md-6">
        <h2 class="mb-2 mt-4 fs-3 font-bold">{{ product.name }}</h2>
        <h3 class="mb-2">{{ product.description }}</h3>
        <p class="mb-1"><strong>Call: </strong> 098753527</p>
        <div class="flex gap-3">
          <p class="price text-danger font-weight-bold mb-2" :class="{ 'text-decoration-line-through': product.discounts && product.discounts.length > 0 }">
            <strong>Price: </strong> ${{ product.price }}
          </p>
          <p class="price text-success font-weight-bold mb-2" v-if="product.discounts && product.discounts.length > 0">
            ${{ calculateDiscountedPrice(product.price, product.discounts[0].discount) }}
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
        <div class="color-options mb-3">
          <h5 class="mb-2">Color:</h5>
          <div class="d-flex flex-wrap">
            <div
              v-for="color in product.colors"
              :key="color.id"
              :style="{ backgroundColor: color.hex_code }"
              :class="[
                'color-circle',
                'mr-2',
                'cursor-pointer',
                `bg-${color.name.toLowerCase()}`,
                { selected: selectedColor[index] === color.id }
              ]"
              @click="toggleColorSelection(index, color.id)"
            ></div>
          </div>
        </div>
        <div class="size-options mb-3">
          <h5 class="mb-2">Size:</h5>
          <select class="form-select w-auto" v-model="selectedSize[index]">
            <option v-for="size in product.sizes" :key="size.id" :value="size.id">{{ size.name }}</option>
          </select>
        </div>
        <div class="quantity mb-4">
          <h5 class="mb-2">Quantity:</h5>
          <div class="input-group w-auto">
            <div class="quantity-input">
              <button @click="decrementQuantity(index)" class="decrement btn btn-outline-secondary">
                -
              </button>
              <input class="input-group min-max" type="text" v-model="quantities[index]" />
              <button @click="incrementQuantity(index)" class="increment btn btn-outline-secondary">
                +
              </button>
            </div>
          </div>
        </div>
        <router-link @click="createOrder" to="/payment" class="btn btn-warning btn-block ml-4 mb-4"> Pay Now</router-link>
      </div>
    </div>
  </div>
</template>

<script setup lang="ts">
import { ref, computed, onMounted } from 'vue';
import axiosInstance from '@/plugins/axios';
import { useRoute } from 'vue-router';

const route = useRoute();
const productId = computed(() => route.params);
const product = ref({});
const orderProducts = ref([]); // Reactive reference for order products
const selectedColor = ref([]); // Reactive reference for selected color
const selectedSize = ref([]); // Reactive reference for selected size
const quantities = ref([]); // Reactive reference for quantities

const fetchProductDetails = async () => {
  try {
    const response = await axiosInstance.get(`/product/show/${productId.value.id}`);
    const productData = response.data.data;
    orderProducts.value.push(productData);
    selectedColor.value.push(null);
    selectedSize.value.push(null);
    quantities.value.push(1);
    console.log(orderProducts.value);
    
  } catch (error) {
    console.error('Error fetching product details:', error);
  }
};

const total = computed(() => {
  return orderProducts.value.reduce((sum, product, index) => {
    if (product.price && quantities.value[index]) {
      return sum + (product.price * quantities.value[index]);
    }
    return sum;
  }, 0);
});

onMounted(() => {
  fetchProductDetails();
});

const getImageUrl = (imagePath) => {
  return imagePath ? `http://127.0.0.1:8000/storage/${imagePath}` : '/default-image.jpg';
};

const incrementQuantity = (index) => {
  quantities.value[index]++;
};

const decrementQuantity = (index) => {
  if (quantities.value[index] > 1) {
    quantities.value[index]--;
  }
};

const toggleColorSelection = (index, colorId) => {
  selectedColor.value[index] = colorId;
};

const calculateDiscountedPrice = (originalPrice, discountPercentage) => {
  const discount = (originalPrice * discountPercentage) / 100;
  return originalPrice - discount;
};

const createOrder = async () => {
  const orderProduct = {
    product_id: orderProducts.value.map(product => product.id),
    color_id: selectedColor.value,
    size_id: selectedSize.value,
    qty: quantities.value,
  };

  try {
    const response = await axiosInstance.post('/orders/create', orderProduct);
    console.log('Order product:', orderProduct); // Logging orderProduct
    console.log('Order created successfully:', response.data);
  } catch (error) {
    console.error('Error creating order:', error);
  }
};

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
</style>

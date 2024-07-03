<template>
  <div class="container" style="margin-top: 120px;">
    <div class="d-flex justify-content-between align-items-center mb-4">
      <router-link to="/shop" class="btn btn-outline-primary">Back</router-link>
      <h2 class="text-center font-bold fs-2 mb-0 text-info">{{ category.name }}</h2>
      <div class="d-flex align-items-center">
        <span class="me-2 fw-bold">SORT BY:</span>
        <select class="form-select form-select-sm w-auto" v-model="sortBy" @change="fetchProductsByCategory">
          <option value="price">Lowest Price</option>
          <option value="popularity">Most Relevant</option>
          <option value="rating">Highest Rating</option>
        </select>
      </div>
    </div>

    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-4 mb-4">
      <div class="col" v-for="product in products" :key="product.id">
        <div class="card h-100 shadow-sm position-relative">
          <div class="cart-icon">
            <div class="shop-icon">
              <i class="fa fa-shopping-cart"></i>
            </div>
            <div class="favorite-icon">
              <i :class="['fa', product.isFavorite ? 'fa-heart' : 'fa-heart-o']"></i>
            </div>
          </div>
          <router-link :to="'/product/detail/' + product.id" class="image-container mt-2 flex items-center justify-center mb-4 text-3xl text-blue-500">
            <img :src="getImageUrl(product.image)" class="card-img-top" alt="Product Image">
          </router-link>
          <div class="card-body d-flex flex-column justify-content-between">
            <div>
              <h5 class="card-title">{{ product.name }}</h5>
              <p class="card-text text-danger fw-bold">${{ product.price }}</p>
              <p class="card-text">{{ product.description }}</p>
              <!-- Optionally display other product details like colors, sizes, etc. -->
            </div>
            <div class="group">
              <router-link
                :to="'/product/detail/' + product.id"
                class="button me-2 items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
              >
                Buy Now
              </router-link>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import axios from 'axios';
import { useRoute } from 'vue-router';

const route = useRoute();
const categoryId = ref(route.params.id); // Note: 'id' should match the param name in your route definition
const products = ref([]);
const category = ref({});
const sortBy = ref('price');

const fetchCategory = async () => {
  try {
    const response = await axios.get(`http://127.0.0.1:8000/api/category/show/${categoryId.value}`);
    category.value = response.data.category;
    products.value = response.data.products;
  } catch (error) {
    console.error('Error fetching category:', error);
  }
};

const fetchProductsByCategory = async () => {
  try {
    const response = await axios.get(`http://127.0.0.1:8000/api/category/show/${categoryId.value}?sortBy=${sortBy.value}`);
    products.value = response.data.products;
  } catch (error) {
    console.error('Error fetching products by category:', error);
  }
};

onMounted(() => {
  fetchCategory();
  fetchProductsByCategory();
});

const getImageUrl = (imagePath) => {
  return imagePath ? `http://127.0.0.1:8000/storage/${imagePath}` : '/default-image.jpg'
};
</script>

<style scoped>
.card {
  transition: transform 0.3s ease, box-shadow 0.3s ease;
  border-radius: 15px;
  overflow: hidden;
  cursor: pointer;
}

.card:hover {
  transform: translateY(-5px);
  box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
}

.card-body {
  background-color: #f8f9fa;
}

.rating .star {
  font-size: 20px;
}

.text-warning {
  color: #ffcc00;
}

.title h4 {
  text-align: center;
  margin-top: 20px;
  margin-bottom: 20px;
  font-size: 30px;
  color: #000;
  font-weight: 600;
  font-family: 'Poppins', sans-serif;
}

.title .text-s {
  text-align: center;
  margin-top: 20px;
  margin-bottom: 20px;
  font-size: 20px;
  color: #000;
}

button {
  display: inline-flex;
  align-items: center;
  justify-content: center;
}

.cart-icon {
  display: flex;
  justify-content: end;
  font-size: 25px;
  color: #000;
  border-radius: 50%;
  margin-right: 10px;
}

.shop-icon {
  margin-right: 10px;
  color: rgb(248, 163, 5);
}

.favorite-icon .fa-heart {
  color: #ff0000;
}

@media (max-width: 768px) {
  .card-wrapper {
    width: 100%;
  }
}
</style>

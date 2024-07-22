<template>
  <div class="container " style="margin-top: 120px; margin-bottom:20px">
    <div class="d-flex justify-content-between align-items-center mb-4">
      <router-link to="/shop" class="btn btn-outline-primary">Back</router-link>
      <h2 class="text-center font-bold fs-2 mb-0 text-info">{{ category.name }}</h2>
      <div class="d-flex align-items-center mr-5">
        <span class="me-2 fw-bold">SORT BY:</span>
        <select class="form-select form-select-sm w-auto" v-model="sortBy" @change="fetchProductsByCategory">
          <option value="price">Lowest Price</option>
          <option value="popularity">Most Relevant</option>
          <option value="rating">Highest Rating</option>
        </select>
      </div>
    </div>

    <div class="container-card card-me">
      <div class="card-wrapper" v-for="product in all_products" :key="product.id">
        <div class="card h-100 shadow-sm position-relative">
          <div class="image-container">
            <div class="flex justify-between absolute w-full mt-1">
              <div class="discount-banner mt-1">
                <span  v-if="product.discounted_price !== null" class="discount-text bg-orange-500 px-4 py-2 rounded-md text-white text-2xl">
                  {{ product.discount }}% OFF
                </span>
              </div>
              <div class="cart-icon">
                <div class="shop-icon" @click="addToCart(product)">
                  <i class="fa fa-shopping-cart"></i>
                </div>
                <div class="favorite-icon">
                  <i :class="['fa', product.isFavorite ? 'fa-heart' : 'fa-heart-o']"></i>
                </div>
              </div>
            </div>
            <div class="image-container">
              <router-link :to="'/product/detail/' + product.id">
                <img :src="getImageUrl(product.image)" class="card-img-top" alt="Product Image">
              </router-link>
            </div>
          </div>
          <div class="text-start p-4">
            <h5 class="card-title">{{ product.name }}</h5>
            <p class="card-text text-danger fw-bold" v-if="product.discounted_price !== null">
              <span class="text-danger fw-bold" style="text-decoration: line-through;">${{ product.price }}</span>
              <span class="text-success ms-2">${{ product.discounted_price }}</span>
            </p>
            <p class="card-text text-danger fw-bold" v-else>
              ${{ product.price }}
            </p>
            <p class="card-text">{{ product.description }}</p>
            <div class="group mt-2">
              <router-link :to="{path:'/product/detail/' + product.id, query:{customer:customerId} }" class="button"> Buy Now</router-link>
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
const all_products = ref([]);
const category = ref({});
const sortBy = ref('price');
const customerId = ref(route.query.user)

const fetchCategory = async () => {
  try {
    const response = await axios.get(`http://127.0.0.1:8000/api/category/show/${categoryId.value}`);
    category.value = response.data.category;
    all_products.value = response.data.all_products.map(product => ({
      ...product,
      discounted_price: calculateDiscountedPrice(product),
      discount: product.discounts && product.discounts.length > 0 ? product.discounts[0].discount : null
    }));
    console.log(all_products.value);
  } catch (error) {
    console.error('Error fetching category:', error);
  }
};

const fetchProductsByCategory = async () => {
  try {
    const response = await axios.get(`http://127.0.0.1:8000/api/category/show/${categoryId.value}?sortBy=${sortBy.value}`);
    all_products.value = response.data.all_products.map(product => ({
      ...product,
      discounted_price: calculateDiscountedPrice(product),
      discount: product.discounts && product.discounts.length > 0 ? product.discounts[0].discount : null
    }));
    console.log(all_products.value);
  } catch (error) {
    console.error('Error fetching products by category:', error);
  }
};

onMounted(() => {
  fetchCategory();
  fetchProductsByCategory();
});

const getImageUrl = (imagePath) => {
  return imagePath ? `http://127.0.0.1:8000/storage/${imagePath}` : '/default-image.jpg';
};

const calculateDiscountedPrice = (product) => {
  if (product.discounts && product.discounts.length > 0) {
    const discount = product.discounts[0];
    const discountedPrice = product.price - (product.price * (discount.discount / 100));
    return parseFloat(discountedPrice.toFixed(2)).toString();
  }
  return null;
};


const addToCart = (product) => {
  axios.post('http://127.0.0.1:8000/api/cart/create', {
    product_id: product.id,
    quantity: 1,
  }, {
    headers: {
      Authorization: `Bearer ${localStorage.getItem('access_token')}`
    }
  })
  .then(response => {
    console.log('Product added to cart:', product);
    alert(`${product.name} add to card successfully.`);
  })
  .catch(error => {
    console.error('Error adding to cart:', error);
  });
}
const toggleFavorite = (product) => {
  product.isFavorite = !product.isFavorite;
};
</script>

<style scoped>

.container-card {
  display: flex;
  flex-wrap: wrap;
  justify-content: flex-start;
  align-items: flex-start;
}

.card-wrapper {
  width: 23%;
  margin: 10px;
  transition: transform 0.3s ease, box-shadow 0.3s ease;
  border-radius: 15px;
  overflow: hidden;
  cursor: pointer;
}

.card-wrapper:hover {
  transform: translateY(-5px);
}

.image-container {
  height: 240px;
  display: flex;
  justify-content: start;
  overflow: hidden;
  background-color: #f0f0f0;
}

.image-container {
  max-width: 100%;
  max-height: 100%;
  object-fit: cover;
}

.button {
  display: inline-block;
  padding: 8px 16px;
  font-size: 14px;
  font-weight: 500;
  text-align: center;
  color: white;
  background-color: #007bff;
  border-radius: 4px;
  text-decoration: none;
  transition: background-color 0.3s ease;
}

.button:hover {
  background-color: #0056b3;
}

.card {
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
  color: orange;
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
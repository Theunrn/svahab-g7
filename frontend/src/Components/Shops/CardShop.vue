<template>
  <div class="title">
    <h4>Let shopping with our products here!</h4>
    <p class="text-s text-center">
      Our shop sells all the sports materials for players who booked fields, and you can come to take them directly.
    </p>
    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-4 p-5">
      <div class="col" v-for="product in products" :key="product.id">
          <div class="card h-100 shadow-sm position-relative">
            <div class="cart-icon">
              <div  class="shop-icon" @click="addToCart(product)">
                <i class="fa fa-shopping-cart"></i>
              </div>
              <div class="favorite-icon" @click="toggleFavorite(product)">
                <i :class="['fa', product.isFavorite ? 'fa-heart' : 'fa-heart-o']"></i>
              </div>
            </div>
            
            <router-link to="/product/detail" class="mt-2 flex items-center justify-center mb-4 text-3xl text-blue-500" width="150px" height="150px">
              <img :src="getImageUrl(product.image)" class="text-center w-90%" alt="Product Image" />
            </router-link>
            <div class="card-body d-flex flex-column justify-content-between">
              <div>
                <h5 class="card-title text-bold">{{ product.name }}</h5>
                <p class="card-text text-danger fw-bold">{{ product.price }}$</p>
                <p class="card-text">{{ product.description }}</p>
                <div class="rating">
                  <span class="star text-warning">&#9733;</span>
                  <span class="star text-warning">&#9733;</span>
                  <span class="star text-warning">&#9733;</span>
                  <span class="star">&#9733;</span> 
                  <span class="star">&#9734;</span>
                </div>
              </div>
              <div class="group">
                <router-link
                  to="/product"
                  class="button me-2 inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                >
                  See More
                </router-link>
                <router-link
                  to="/product/detail"
                  class="button inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-orange-500 rounded-lg hover:bg-orange-600 focus:ring-4 focus:outline-none focus:ring-orange-300 dark:bg-orange-400 dark:hover:bg-orange-500 dark:focus:ring-orange-600"
                  style="margin-left: auto"
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

<script>
import axios from 'axios';

export default {
  data() {
    return {
      products: [],
      cart: [],
      cartCount: 0,
      isFavorite: true
    };
  },
  created() {
    this.fetchProducts(); // Fetch products when the component is created
  },
  methods: {
    fetchProducts() {
      axios.get('http://127.0.0.1:8000/api/product/list')
        .then(response => {
          this.products = response.data; // Assuming your API returns an array of products
        })
        .catch(error => {
          console.error('Error fetching products:', error);
          // Optionally handle errors here (e.g., show a message to the user)
        });
    },
    getImageUrl(imagePath) {
      return `http://127.0.0.1:8000/storage/${imagePath}`; // Adjust URL if needed
    },
    toggleFavorite(product) {
      product.isFavorite = !product.isFavorite;
    }
    
  }
}
</script>




<style scoped>
.card {
  transition: transform 0.3s ease, box-shadow 0.3s ease;
  border-radius: 15px;
  overflow: hidden;
  cursor: pointer;
}

.card:hover{
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
.cart-icon{
  display: flex;
  justify-content: end;
  font-size: 25px;
  color: #000;
  border-radius: 50%;
  margin-right: 10px;
}
.shop-icon{
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

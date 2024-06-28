<template>
  <div class="title">
    <h4>Let's shop with our products here!</h4>
    <p class="text-s text-center">
      Our shop sells all the sports materials for players who book fields, and you can come to pick them up directly.
    </p>
    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-4 p-5">
      <div class="col" v-for="product in products" :key="product.id">
        <div class="card h-100 shadow-sm">
          <div class="mt-2 flex items-center justify-center mb-4 text-3xl text-blue-500" width="150px" height="150px">
            <img width="150px" height="150px" :src="getImageUrl(product.image)" class="text-center" alt="Product Image" />
          </div>
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
                class="button me-2 inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
              >
                See More
              </router-link>
              <router-link
                class="button inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-orange-500 rounded-lg hover:bg-orange-600 focus:ring-4 focus:outline-none focus:ring-orange-300 dark:bg-orange-400 dark:hover:bg-orange-500 dark:focus:ring-orange-600"
                style="margin-left: auto"
              >
                Add to Cart
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
    };
  },
  created() {
    this.fetchProducts(); // Fetch products when the component is created
  },
  methods: {
    fetchProducts() {
      axios.get('http://127.0.0.1:8000/api/product/list') // Replace with your actual API endpoint
        .then(response => {
          this.products = response.data; // Assuming your API returns an array of products
        })
        .catch(error => {
          console.error('Error fetching products:', error);
        });
    },
    getImageUrl(imagePath) {
      return `http://127.0.0.1:8000/storage/${imagePath}`; // Adjust URL if needed
    }
  }
}
</script>


<style>
.card-me {
  justify-content: center;
  flex-wrap: wrap;
}

.card-wrapper {
  width: 23%;
  transition: transform 0.3s ease;
}

.card-wrapper:hover {
  transform: scale(1.05);
}

.overlay {
  z-index: 5;
  background-color: rgba(0, 0, 0, 0.5);
  opacity: 0;
  transition: opacity 0.3s ease;
}

.card-wrapper:hover .overlay {
  opacity: 1;
}

@media (max-width: 768px) {
  .card-wrapper {
    width: 100%;
  }
}
h4 {
  text-align: center;
  margin-top: 20px;
  margin-bottom: 20px;
  font-size: 30px;
  color: #000;
  font-weight: 600;
  font-family: 'Poppins', sans-serif;
}
.text {
  text-align: center;
  margin-top: 20px;
  margin-bottom: 20px;
  font-size: 20px;
  color: #000;
}
</style>
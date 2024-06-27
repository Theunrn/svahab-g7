<template>
  <div class="title">
    <h4>Let shopping with our products here!</h4>
    <p class="text-s text-center">
      Our shop sells all the sport materials for players who book fields, and you can come to take them directly.
    </p>
    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-4 p-5">
      <div class="col" v-for="product in products" :key="product.id">
        <div class="card h-100 shadow-sm">
          <div class="mt-2 flex items-center justify-center mb-4 text-3xl text-blue-500" style="width: 150px; height: 150px;">
            <img width="150px" height="150px" :src="product.image" class="text-center" alt="Product Image" />
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
  mounted() {
  axios.get('http://127.0.0.1:8000/api/product/list')
    .then(response => {
      this.products = response.data.products;
      console.log('Products loaded:', this.products);
      // Log product images to verify paths
      this.products.forEach(product => {
        console.log('Product Image:', product.image);
      });
    })
    .catch(error => {
      console.error('Error fetching data:', error);
    });
}

};
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

.button {
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

<template>
  <div class="container" style="margin-top: 120px;">
    <div class="d-flex justify-content-between align-items-center mb-4">
      <a href="/shop" class="btn btn-outline-primary">Back</a>
      <h2 class="text-center font-bold fs-2 mb-0 text-info">Football Balls</h2>
      <div class="d-flex align-items-center">
        <span class="me-2 fw-bold">SORT BY:</span>
        <select class="form-select form-select-sm w-auto">
          <option value="price">Most Relevant</option>
          <option value="popularity">Lowest Price</option>
          <option value="rating">Highest Price</option>
        </select>
      </div>
    </div>

    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-4 mb-4">
      <div class="col" v-for="index in 4" :key="index">
        <div class="card h-100 shadow-sm position-relative">
          <div class="cart-icon">
            <div class="shop-icon">
              <i class="fa fa-shopping-cart"></i>
            </div>
            <div class="favorite-icon">
              <i class="fa fa-heart-o"></i>
            </div>
          </div>
          <router-link to="/product/detail" class="image-container mt-2 flex items-center justify-center mb-4 text-3xl text-blue-500">
            <img src="../../assets/ShopImage/card/ball.png" class="card-img-top" alt="Football ball">
          </router-link>
          <div class="card-body d-flex flex-column justify-content-between">
            <div>
              <h5 class="card-title">Ball</h5>
              <p class="card-text text-danger fw-bold">$10</p>
              <p class="card-text">Mini Football Sunny 300 Size 1 - Pastel Blue</p>
              <div class="rating">
                <span class="star">&#9733;</span>
                <span class="star">&#9733;</span>
                <span class="star">&#9733;</span>
                <span class="star">&#9733;</span>
                <span class="star">&#9734;</span>
              </div>
            </div>
            <div class="group">
              <router-link
                to="/product/detail"
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

<script setup lang="ts">
// No changes in the script section
</script>

<style scoped>
.container {
  max-width: 1280px;
  height: 50%;
}

.card {
  border-radius: 15px;
  overflow: hidden;
  transition: all 0.3s ease-in-out;
  cursor: pointer;
  position: relative;
}

.card:hover {
  background-color: #f1f1f1;
  box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
  transform: translateY(-5px);
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
  color: rgb(238, 158, 8);
}

.favorite-icon .fa-heart {
  color: #ff0000;
}

.image-container {
  width: 100%;
  height: 150px; /* Adjust height as needed */
  display: flex;
  justify-content: center;
  align-items: center;
}

.card-img-top {
  max-width: 200px; /* Adjust max-width as needed */
  max-height: 200px; /* Adjust max-height as needed */
}

.card-body {
  background-color: #f8f9fa;
}

.rating .star {
  color: #ffcc00;
  font-size: 20px;
}

.btn-primary {
  background-color: #4093ec;
  border-color: #007bff;
  transition: all 0.3s ease-in-out;
}

.btn-primary:hover {
  background-color: #e0ae09;
  border-color: #c5da0b;
}

.group {
  display: flex;
  justify-content: end;
}
</style>

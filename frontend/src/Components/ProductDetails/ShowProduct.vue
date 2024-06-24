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

    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-4">
      <div class="col" v-for="index in 8" :key="index">
        <div class="card h-100 shadow-sm">
          <img src="../../assets/ShopImage/card/ball.png" class="card-img-top" alt="Football ball">
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
            <router-link to="/product/detail" class="btn btn-primary">Buy now</router-link>
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
  max-width: 1200px;
}

.card {
  border-radius: 15px;
  overflow: hidden;
  transition: all 0.3s ease-in-out;
  cursor: pointer;
}

.card:hover {
  background-color: #f1f1f1;
  box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
  opacity: 1;
  transform: translateY(0);
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
</style>

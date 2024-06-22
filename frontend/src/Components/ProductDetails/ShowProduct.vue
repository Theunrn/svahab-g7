<template>
    <div class="container my-5">
      <div class="d-flex justify-content-between align-items-center mb-4">
        <a href="/shop" class="btn btn-outline-primary">Back</a>
        <h4 class="text-center mb-0">Football Balls</h4>
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
            <img src="../../assets/ShopImage/card/ball.jpg" class="card-img-top" alt="Football ball">
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
  
  <style>
    .container {
      max-width: 1200px;
    }
  
    .card {
      border-radius: 15px;
      overflow: hidden;
    }
  
    .card-body {
      background-color: #f8f9fa;
    }
  
    .rating .star {
      color: #ffcc00;
      font-size: 20px;
    }
  
    .btn-primary {
      background-color: #007bff;
      border-color: #007bff;
      transition: all 0.3s ease-in-out;
    }
  
    .btn-primary:hover {
      background-color: #0056b3;
      border-color: #0056b3;
    }
  </style>
<template>
    <div class="product-detail container my-5">
      <div class="row mb-3">
        <div class="col-12">
          <router-link to="/product" class="btn btn-outline-primary">
            Back
          </router-link>
        </div>
      </div>
      <div class="row">
        <!-- Image Section -->
        <div class="col-md-6">
          <div class="product-images">
            <img src="../../assets/ShopImage/card/ball.jpg" class="img-fluid" alt="Football ball">
          </div>
        </div>
        <!-- Product Details Section -->
        <div class="col-md-6">
          <h2 class="mb-2">Ball</h2>
          <h3 class="mb-3">Mini Football Sunny 300 Size 1 - Pastel Blue</h3>
          <p class="mb-1">Reference: 8753527</p>
          <p class="price text-success font-weight-bold mb-3">$10</p>
          <p class="mb-3">Tax included</p>
          <div class="rating mb-3">
            <span class="star text-warning">&#9733;</span>
            <span class="star text-warning">&#9733;</span>
            <span class="star text-warning">&#9733;</span>
            <span class="star text-warning">&#9733;</span>
            <span class="star text-warning">&#9733;</span>
            <span>(1053 reviews)</span>
          </div>
          <div class="color-options mb-3">
            <h5 class="mb-2">Color:</h5>
            <div class="d-flex">
              <div class="color-circle bg-pink mr-2 cursor-pointer"></div>
              <div class="color-circle bg-blue mr-2 cursor-pointer"></div>
            </div>
          </div>
          <div class="size-options mb-3">
            <h5 class="mb-2">Size:</h5>
            <select class="form-select w-auto">
              <option value="1">1</option>
            </select>
          </div>
          <div class="quantity mb-4">
            <h5 class="mb-2">Quantity:</h5>
            <div class="input-group w-auto">
              <div class="quantity-input">
                <button class="decrement btn btn-outline-secondary">-</button>
                <input class="input-group min-max" type="text" value="1" />
                <button class="increment btn btn-outline-secondary">+</button>
              </div>
            </div>
          </div>
          <button class="btn btn-warning btn-block mb-4">Add To Cart</button>
          <div class="delivery-info mb-4">
            <p class="mb-1"><strong>Home Delivery:</strong> Available within 48 hours</p>
            <p class="mb-0"><strong>Click & Collect:</strong> Pickup in store within 4 hours</p>
          </div>
          <div class="product-description">
            <p>
              Our product designers, themselves football players, designed the Sunny 300 mini ball for kids starting to dribble, shoot, or juggle with their hands or feet.
            </p>
            <p class="mb-0">
              Looking for a ball to learn the basics of football? This mini plastic football is perfect. Plus, it's ideal for playing barefoot.
            </p>
          </div>
        </div>
      </div>
    </div>
  </template>
  
  <script>
  export default {
    setup() {
      // No changes in the script section
    },
  }
  </script>
  
  <style>
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
  
  .color-options .color-circle {
    width: 30px;
    height: 30px;
    border-radius: 50%;
    border: 1px solid #ddd;
    cursor: pointer;
  }
  
  .bg-pink {
    background-color: pink;
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
<template>
  <div class="product-detail my-5">
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
          <img src="../../assets/ShopImage/card/ball.png" class="img-fluid" alt="Football ball" />
        </div>
      </div>
      <!-- Product Details Section -->
      <div class="col-md-6">
        <h2 class="mb-2 mt-4 fs-3 font-bold">Ball</h2>
        <h3 class="mb-2">Mini Football Sunny 300 Size 1 - Pastel Blue</h3>
        <p class="mb-1"><strong>Call:</strong> 098753527</p>
        <p class="price text-success font-weight-bold mb-2"><strong>Price:</strong> $10</p>
        <p class="mb-2">Tax included</p>
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
          <div class="flex">
            <div class="relative mr-2">
              <input type="color" class="absolute inset-0 opacity-0 cursor-pointer" value="#ffff00" @change="setColor($event.target.value)">
              <div class="w-8 h-8 rounded-full" :style="{ backgroundColor: '#ffff00', border: selectedColor === '#ffff00' ? '2px solid #000' : 'none' }"></div>
            </div>
            <div class="relative mr-2">
              <input type="color" class="absolute inset-0 opacity-0 cursor-pointer" value="#0000ff" @change="setColor($event.target.value)">
              <div class="w-8 h-8 rounded-full" :style="{ backgroundColor: '#0000ff', border: selectedColor === '#0000ff' ? '2px solid #000' : 'none' }"></div>
            </div>
            <div class="relative mr-2">
              <input type="color" class="absolute inset-0 opacity-0 cursor-pointer" value="#000000" @change="setColor($event.target.value)">
              <div class="w-8 h-8 rounded-full" :style="{ backgroundColor: '#000000', border: selectedColor === '#000000' ? '2px solid #000' : 'none' }"></div>
            </div>
          </div>
        </div>
        <div class="flex gap-5">
          <div class="size-options mb-3 w-30">
            <h5 class="mb-2">Size:</h5>
            <select class="form-select">
              <option value="M">M</option>
              <option value="S">S</option>
              <option value="L">L</option>
              <option value="XL">XL</option>
              <option value="XXL">XXL</option>
            </select>
          </div>
          <div class="quantity mb-4">
            <h5 class="mb-2">Quantity:</h5>
            <div class="quantity-input flex gap-1">
              <button type="button" class="decrement btn btn-outline-secondary" @click="decrementQty">-</button>
              <input class="input-group min-max rounded-md text-center" type="number" v-model.number="qty" min="1" />
              <button type="button" class="increment btn btn-outline-secondary" @click="incrementQty">+</button>
            </div>
          </div>
        </div>
        <button @click="handleOrder" class="btn btn-green btn-block mb-4 rounded-md shadow-lg mr-3">Order</button>
        <router-link to="/payment" class="btn btn-warning btn-block mb-4">Pay Now</router-link>
        <div class="delivery-info mb-4">
          <p><strong>Home Delivery:</strong> Available within 48 hours</p>
          <p><strong>Click & Collect:</strong> Pickup in store within 4 hours</p>
        </div>
        <div class="product-description">
          <p>
            Our product designers, themselves football players, designed the Sunny 300 mini ball for kids starting to dribble, shoot, or juggle with their hands or feet.
          </p>
          <p>
            Looking for a ball to learn the basics of football? This mini plastic football is perfect. Plus, it's ideal for playing barefoot.
          </p>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import axiosInstance from '../../plugins/axios'; // Adjust import path as necessary

export default {
  data() {
    return {
      qty: 1, 
      selectedColor: '#F5F5F5', 
      colors: ['#ffff00', '#0000ff', '#000000'], 
      productId: 2 
    };
  },
  methods: {
    handleOrder() {
      axiosInstance
        .post('/orders/create', {
          product_id: this.productId,
          qty: this.qty,
          color: this.selectedColor
        })
        .then(response => {
          console.log('Order placed successfully:', response.data);
          // Optionally, you can handle success behavior here (e.g., redirect)
        })
        .catch(error => {
          console.error('Error placing order:', error);
          if (error.response) {
            console.error('Response data:', error.response.data);
            console.error('Response status:', error.response.status);
          } else {
            console.error('Error message:', error.message);
          }
        });
    },
    setColor(color) {
      this.selectedColor = color;
    },
    incrementQty() {
      this.qty++;
    },
    decrementQty() {
      if (this.qty > 1) {
        this.qty--;
      }
    }
  }
};
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

.color-options .relative {
  display: inline-block;
  position: relative;
}

.color-options .absolute {
  position: absolute;
}

.color-options .cursor-pointer {
  cursor: pointer;
}

.color-options .opacity-0 {
  opacity: 0;
}

.quantity-input {
  display: flex;
  align-items: center;
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

.btn {
  background-color: #fff;
  color: #000;
  text-decoration: none;
  cursor: pointer;
  transition: all 0.3s ease-in-out;
  outline: none;
  border: none;
  box-shadow: 0px 0px 10px 0px rgba(0, 0, 0, 0.2);
}

.btn-green {
  background-color: #28a745;
  color: #fff;
}

.btn-green:hover {
  background-color: #218838;
}

.btn-warning {
  background-color: #ffc107;
  color: #fff;
}

.btn-warning:hover {
  background-color: #e0a800;
}

.mb-2 {
  margin-bottom: 0.5rem;
}

.mb-4 {
  margin-bottom: 1rem;
}

</style>

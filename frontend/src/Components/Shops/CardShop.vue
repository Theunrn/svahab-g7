<template>
  <div class="title">
    <h4>Let shoping wiht our product here!</h4>
    <p class="text-s text-center">
      Our shop sell all the sport material for player who booked fields and you can come to take it
      directly.
    </p>
    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-4 p-5">
      <div class="col" v-for="product in products" :key="product.id">
        <div class="card h-100 shadow-sm">
          <div class="mt-2 flex items-center justify-center mb-4 text-3xl text-blue-500" width="150px" height="150px" >
            <img width="150px" height="150px" :src="product.image" class=" text-center" alt="Product Image" />
          </div>
          <div class="card-body d-flex flex-column justify-content-between">
            <div>
              <h5 class="card-title text-bold">{{ product.name }}</h5>
              <p class="card-text text-danger fw-bold">{{ product.price }}$</p>
              <p class="card-text">{{ product.description }}</p>
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
export default {
  setup() {},
  data(){
    return {
      products:[
        {
        id: 1,
        name: 'Ball',
        price: 10,
        image: 'https://www.slazzer.com/downloads/7c8af552-309e-11ef-8754-42010a80000a/image_prev_ui.png',
        description: 'Mini Football Sunny 300 Size 1 - Pastel Blue'
      },
        {
        id: 2,
        name: 'Uniform',
        price: 15,
        image: 'https://www.slazzer.com/downloads/a919c094-309e-11ef-b7a6-42010a80000a/image_prev_ui.png',
        description: 'Mini Football Sunny 300 Size 1 - Pastel Blue'
      },
        {
        id: 3,
        name: 'Soccer Sock',
        price: 15,
        image: 'https://www.slazzer.com/downloads/41dc93be-30a0-11ef-bb37-42010a80000a/image_prev_ui.png',
        description: 'Mini Football Sunny 300 Size 1 - Pastel Blue'
      },
        {
        id: 4,
        name: 'Soccer Cleats',
        price: 10,
        image: 'https://www.slazzer.com/downloads/f68e531c-309e-11ef-bb37-42010a80000a/image_prev_ui.png',
        description: 'Mini Football Sunny 300 Size 1 - Pastel Blue'
      },
        {
        id: 5,
        name: 'Shin Guards',
        price: 10,
        image: 'https://www.slazzer.com/downloads/3828ba60-309f-11ef-bb37-42010a80000a/image_prev_ui.png',
        description: 'Mini Football Sunny 300 Size 1 - Pastel Blue'
      },
        {
        id: 6,
        name: 'Coalkeeper Gloves',
        price: 10,
        image: 'https://www.slazzer.com/downloads/622d11a8-309f-11ef-af54-42010a800009/image_prev_ui.png',
        description: 'Mini Football Sunny 300 Size 1 - Pastel Blue'
      },
        {
        id: 7,
        name: 'Water Bottle',
        price: 10,
        image: 'https://www.slazzer.com/downloads/9533e43c-309f-11ef-8754-42010a80000a/image_prev_ui.png',
        description: 'Mini Football Sunny 300 Size 1 - Pastel Blue'
      },
        {
        id: 8,
        name: 'Cear Bag',
        price: 10,
        image: 'https://www.slazzer.com/downloads/f1ba8d64-309f-11ef-a189-42010a80000a/image_prev_ui.png',
        description: 'Mini Football Sunny 300 Size 1 - Pastel Blue'
      },

    ]
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
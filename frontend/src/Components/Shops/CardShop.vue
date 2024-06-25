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
        image: 'https://cdn.britannica.com/68/195168-050-BBAE019A/football.jpg',
        description: 'Mini Football Sunny 300 Size 1 - Pastel Blue'
      },
        {
        id: 2,
        name: 'Sport Cloth',
        price: 15,
        image: 'https://s.alicdn.com/@sc04/kf/Habf4d374b47548fb944c63c2d15e6580X.jpg_300x300.jpg',
        description: 'Mini Football Sunny 300 Size 1 - Pastel Blue'
      },
        {
        id: 3,
        name: 'Soccer Sock',
        price: 15,
        image: 'https://soccerzoneusa.com/cdn/shop/products/SX5728-100-PHCFH001_590x.jpg?v=1588263965',
        description: 'Mini Football Sunny 300 Size 1 - Pastel Blue'
      },
        {
        id: 4,
        name: 'Soccer Cleats',
        price: 10,
        image: 'https://i.ebayimg.com/images/g/6GEAAOSwWGZkVbFZ/s-l1200.jpg',
        description: 'Mini Football Sunny 300 Size 1 - Pastel Blue'
      },
        {
        id: 5,
        name: 'Shin Guards',
        price: 10,
        image: 'https://soccerzoneusa.com/cdn/shop/products/SP0040-009-PHSFH001_875x.jpg?v=1588263959',
        description: 'Mini Football Sunny 300 Size 1 - Pastel Blue'
      },
        {
        id: 6,
        name: 'Coalkeeper Gloves',
        price: 10,
        image: 'https://m.media-amazon.com/images/I/61bndwlfJSL._AC_UF1000,1000_QL80_.jpg',
        description: 'Mini Football Sunny 300 Size 1 - Pastel Blue'
      },
        {
        id: 7,
        name: 'Water Bottle',
        price: 10,
        image: 'https://football-futures.com/wp-content/uploads/2021/12/Waterv-bottle-2.png',
        description: 'Mini Football Sunny 300 Size 1 - Pastel Blue'
      },
        {
        id: 8,
        name: 'Cear Bag',
        price: 10,
        image: 'https://contents.mediadecathlon.com/p2161169/k$bbd724010de90a72409e266044a48426/45l-sports-bag-hardcase-black.jpg?format=auto&quality=70&f=1366x1366',
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
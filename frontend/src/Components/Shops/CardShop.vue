<template>
  <div class="container">
    <h4>This Is Our Products</h4>
    <p class="text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Fugiat modi quis numquam culpa facilis totam corporis natus eveniet ullam debitis nemo sequi nesciunt quos tempora ducimus, et perferendis odit nam?</p>
    <div class="card-me flex flex-wrap justify-content-start align-items-start ml-5">
      <div class="card-wrapper relative w-1/4 sm:w-full mx-2 my-5" v-for="index in 4" :key="index" >
        <div class="max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700 overflow-hidden">
          <router-link :to="{ name: 'Detail', params: { id: 1 } }">
            <img class="rounded-t-lg p-2" src="../../assets/ShopImage/card/img.jpg" alt="" />
          </router-link>
          <div class="p-4 relative z-10">
            <router-link :to="{ name: 'Detail', params: { id: 1 } }">
              <h5 class="mb-2 text-2xl  font-bold tracking-tight text-gray-900 ">Ball</h5>
            </router-link>
            <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">Price:10$</p>
            <router-link to="/product"
              class="button me-2 inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
            >
              See More
            </router-link>
            <router-link to="/product/detail"
                class="button inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-orange-500 rounded-lg hover:bg-orange-600 focus:ring-4 focus:outline-none focus:ring-orange-300 dark:bg-orange-400 dark:hover:bg-orange-500 dark:focus:ring-orange-600"
                style="margin-left: auto;"
              >
                Buy Now
            </router-link>
          </div>
        </div>
      </div>
    </div>
  </div>
    
</template>

<script>
export default {
    setup() {
        
    },
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
  h4{
    text-align: center;
    margin-top: 20px;
    margin-bottom: 20px;
    font-size: 30px;
    color: #000;
    font-weight: 600;
    font-family: 'Poppins', sans-serif;

  }
  .text{
    text-align: center;
    margin-top: 20px;
    margin-bottom: 20px;
    font-size: 20px;
    color: #000;

  }
</style>
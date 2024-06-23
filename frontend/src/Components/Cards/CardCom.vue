<template>
  <div>
    <div class="card-me flex flex-wrap justify-content-start align-items-start ml-10">
      <!-- Loop to generate 6 cards -->
     
      <div class="card-wrapper rounded-md shadow-lg relative w-1/3 sm:w-full mx-2 my-2" v-for="index in 6" :key="index">
        <div class="container bg-overlay">
          <div class="row text-center flex flex-col items-center justify-center h-full">
            <h1 class="text-2xl font-bold mb-4">Football Field Name</h1>
            <div class="btn-group">
              <router-link :to="'/field/detail/' + index">
                <button type="button" class="btn btn-primary btn-details btn-sm py-1 me-2">
                  <font-awesome-icon :icon="['fas', 'info-circle']" class="me-1" /> See Details
                </button>
              </router-link>
              <router-link to="/booking">
                <button
                  type="button"
                  style="background-color: orange"
                  class="btn btn-book btn-sm py-1"
                >
                  <font-awesome-icon :icon="['fas', 'book']" class="me-1" /> Book Now
                </button>
              </router-link>
            </div>
          </div>
        </div>
        <div class="text-start p-4">
          <h3 class="text-1xl font-bold text-gray-900 mb-2">Location</h3>
          <p class="text-gray-700">Find fields near you by searching with location and date.</p>
          <p class="mt-2"><span class="bg-blue text-white p-2 rounded-md mr-2">8.8 $</span>  febulos - 2,965 reviews</p>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'FootballFields'
  // Your component's logic here
}
</script>

<style scoped>
.card-me {
  justify-content: left;
  align-items: start;
  text-align: left;
  flex-wrap: wrap;
}

.card-wrapper {
  width: 23%;
  height: 45%;
  transition: transform 0.3s ease;
  position: relative;

}

.card-wrapper:hover {
  transform: scale(1.05);
}

.bg-overlay {
  background: linear-gradient(rgba(0, 0, 0, 0.3), rgba(0, 0, 0, 0.3)),
    url('../../assets/image/field.png');
  background-repeat: no-repeat;
  background-size: cover;
  background-position: center center;
  color: #fff;
  height: 200px;
  display: flex;
  align-items: center;
  justify-content: center;
  text-align: center;
  padding: 20px;
  border-radius: 6px 6px 0px 0px;
  position: relative;
}

.btn-group {
  position: absolute;
  bottom: 30px;
  width: 80%;
  display: flex;
  justify-content: center;
  opacity: 0;
  transition: opacity 0.3s ease, transform 0.3s ease;
  transform: translateY(20px);
}

/* Show buttons on hover */
.card-wrapper:hover .btn-group {
  opacity: 1;
  transform: translateY(0);
}

@media (max-width: 768px) {
  .card-wrapper {
    width: 100%;
  }
}
</style>


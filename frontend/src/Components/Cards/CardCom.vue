<template>
  <div>
    <div class="card-me flex flex-wrap justify-content-start align-items-start ml-10">
      <!-- Loop to generate 6 cards -->
      <div class="card-wrapper rounded-md shadow-lg relative w-1/3 sm:w-full mx-2 my-2" v-for="index in 8" :key="index">
        <div class="container bg-overlay">
          <div class="row text-center flex flex-col items-center justify-center h-full">
            <div class="btn-group">
              <router-link :to="'/field/detail/' + index">
                <button type="button" class="btn btn-primary btn-details btn-sm py-1 me-2">
                  <font-awesome-icon :icon="['fas', 'info-circle']" class="me-1" /> See Details
                </button>
              </router-link>
            </div>
          </div>
        </div>
        <div class="text-start p-4">
          <div class="text-start">
            <h3 class="text-1xl font-bold text-gray-900 mb-2">LXY Stadium</h3>
            <p class="mt-3 flex items-center gap-2">
              <span class="dollar bg-blue text-white p-1 rounded-md">
                8.8 $
              </span>
              <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21 12 17.27z" fill="#FCD34D" />
              </svg>
              <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21 12 17.27z" fill="#FCD34D" />
              </svg>
              <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21 12 17.27z" fill="#FCD34D" />
              </svg>
              <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21 12 17.27z" fill="#FCD34D" />
              </svg>
              <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21 12 17.27z" fill="#FCD34D" />
              </svg>
            </p>
            <p class="mt-2 flex items-center gap-2">
              <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z" fill="#4B5563" />
              </svg>
              2.4 km from centre
            </p>
          </div>
          <div class="text-right">
            <p class="mt-2">Starting from</p>
            <h3 class="text-1xl font-bold text-gray-900 mb-1">KHR 155,999</h3>
          </div>
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
  height: 40%;
  transition: transform 0.3s ease;
  position: relative;

}

.card-wrapper:hover {
  transform: scale(1.05);
}

.dollar {
  border-radius: 5px 5px 5px 0px;
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

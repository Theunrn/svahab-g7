<template>
  <!-- How It Works -->
  <div class="py-12 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <h2 class="text-3xl font-bold text-gray-900 mb-1 text-center">HOW IT WORKS</h2>
      <p class="text-center mb-5">Learn More About Our Features</p>
      <div class="grid grid-cols-1 md:grid-cols-4 gap-10 mr-7">
        <div class="card rounded-lg shadow-lg p-4 w-76">
          <div class="text-center">
            <div class="flex items-center justify-center mb-4 text-3xl text-blue-500">
              <img width="100" height="100" class="border border-2 border-info avatar-img rounded-circle" src="../../assets/image/search.jpg" alt="">
            </div>
            <h3 class="text-xl font-semibold text-gray-900 mb-2">Search</h3>
            <p class="text-gray-700">Find fields near you by searching with location and date.</p>
          </div>
        </div>
        <div class="card rounded-lg shadow-lg p-4 w-76">
          <div class="text-center">
            <div class="flex items-center justify-center mb-4 text-3xl text-blue-500">
              <img width="100" height="100" class="border border-2 border-info avatar-img rounded-circle" src="../../assets/image/select.avif" alt="">
            </div> 
            <h3 class="text-xl font-semibold text-gray-900 mb-2">Select</h3>
            <p class="text-gray-700">Choose from a variety of fields that match your needs.</p>
          </div>
        </div>
        <div class="card rounded-lg shadow-lg p-4 w-76">
          <div class="text-center">
            <div class="flex items-center justify-center mb-4 text-3xl text-blue-500">
              <img width="100" height="100" class="border border-2 border-info avatar-img rounded-circle" src="../../assets/image/book.png" alt="">
            </div>
            <h3 class="text-xl font-semibold text-gray-900 mb-2">Book</h3>
            <p class="text-gray-700">Book your field easily with our secure online payment system.</p>
          </div>
        </div>
        <div class="card rounded-lg shadow-lg p-4 w-76">
          <div class="text-center">
            <div class="flex items-center justify-center mb-4 text-3xl text-blue-500">
              <img width="100" height="100" class="border border-2 border-info avatar-img rounded-circle" src="../../assets/image/shop.jpg" alt="">
            </div>
            <h3 class="text-xl font-semibold text-gray-900 mb-2">Shop</h3>
            <p class="text-gray-700">Look and buy sport material easily with our secure online payment system.</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {

}
</script>

<style scoped>
.card {
  transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.card:hover {
  transform: translateY(-5px);
  box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
}

@media (max-width: 768px) {
  .card {
    padding: 2rem; /* Reduce padding for smaller screens */
    width: auto; /* Adjust width for smaller screens */
  }
}

@media (max-width: 480px) {
  .card {
    padding: 1rem; /* Further reduce padding for smallest screens */
    width: auto; /* Adjust width for smallest screens */
  }
}
</style>

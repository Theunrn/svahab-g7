<script setup lang="ts">
</script>

<template>
  <header
    class="flex justify-between px-30 py-2 items-center shadow navbar-light navbar-sticky header-static bg-green-600"
  >
    <!-- Logo -->
    <div class="flex items-center space-x-2">
      <a href="/"><img width="25%" height="32%" src="../assets/image/logo.png" alt="Logo" /></a>
    </div>
    <!-- Menu Items -->
    <nav class="flex justify-center space-x-4">
      <a href="/" class="font-bold-200 py-2 text-white custom-hover text-decoration-none me-3">HOME</a>
      <a href="/about" class="font-bold-200 py-2 text-white custom-hover text-decoration-none me-3"
        >ABOUT</a
      >
      <a href="/shop" class="font-bold-200 py-2 text-white custom-hover text-decoration-none me-3"
        >SHOP</a
      >
      <a
        href="/contact"
        class="font-bold-200 py-2 me-5 text-white custom-hover text-decoration-none me-5"
        > CONTACT</a
      >
    </nav>

    <!-- Btn auth -->
    <div class="auth flex gap-2">
      <button
        class="hover:bg-red-400 text-dark bg-white px-4 py-1 border-1 border-red-700 hover:border-red-500 rounded"
      >
        Register
      </button>
      <button
        class="hover:bg-red-400 text-dark bg-white px-4 py-1 border-1 border-red-700 hover:border-red-500 rounded"
      >
      Login
      </button>
    </div>
  </header>
</template>

<style scoped>
.custom-hover {
  padding-bottom: 2px; /* Reduce bottom padding */
  line-height: 0.5; /* Set line height to 1 */
}

.custom-hover:hover {
  border-bottom: 2px solid white;
  border-radius: 5px;
}
</style>

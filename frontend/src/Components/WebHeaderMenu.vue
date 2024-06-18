<script setup lang="ts">
</script>

<template>
  <header class="flex justify-between px-30 py-2 items-center shadow navbar-light navbar-sticky header-static" style="background-color: green">
    <!-- Logo -->
    <div class="flex items-center space-x-2">
      <a href="/"><img width="25%" height="32%" src="../assets/image/logo.png" alt="Logo"></a>
    </div>
    <!-- Menu Items -->
    <nav class="flex justify-center space-x-4">
      <a
        href="/"
        class="font-bold py-2 text-white custom-hover text-decoration-none me-3"
        >Home</a
      >
      <a
        href="/about"
        class="font-bold py-2 text-white custom-hover text-decoration-none me-3"
        >About</a
      >
      <a
        href="/fields"
        class="font-bold py-2 text-white custom-hover text-decoration-none me-3"
        >Fields</a
      >
      <a
        href="/shop"
        class="font-bold py-2 text-white custom-hover text-decoration-none me-3"
        >Shop</a
      >
      <a
        href="/contact"
        class="font-bold py-2 me-5 text-white custom-hover text-decoration-none me-5"
        >Contact</a
      >
    </nav>

    <!-- Profile Dropdown -->
    <div class="dropdown ms-1 ms-lg-0">
      <a class="avatar avatar-sm p-0 " href="#" id="profileDropdown" role="button" data-bs-auto-close="outside" data-bs-display="static" data-bs-toggle="dropdown" aria-expanded="false">
        <img width="50" height="50" class="border border-2 border-white avatar-img rounded-circle" src="../assets/image/profile.jpg" alt="avatar">
      </a>
      <ul class="dropdown-menu dropdown-animation dropdown-menu-end shadow pt-3" aria-labelledby="profileDropdown">
        <li><a class="dropdown-item" href="/profile"><font-awesome-icon icon="user-circle" class="me-2"/> Profile</a></li>
        <li><a class="dropdown-item" href="#"><font-awesome-icon icon="cog" class="me-2"/> Settings</a></li>
        <li><hr class="dropdown-divider"></li>
        <li><a class="dropdown-item" href="#"><font-awesome-icon icon="sign-out-alt" class="me-2"/> Logout</a></li>
      </ul>
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

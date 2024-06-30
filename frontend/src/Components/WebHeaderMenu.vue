<template>
  <header
    style="padding-left: 60px; padding-right: 60px"
    class="flex justify-between py-2 items-center shadow-md navbar-light fixed top-0 left-0 right-0 bg-green-600 z-50"
  >
    <!-- Logo -->
    <div class="flex items-center space-x-2">
      <a href="/"><img width="25%" height="32%" src="../assets/image/logo.png" alt="Logo" /></a>
    </div>
    <!-- Menu Items -->
    <nav class="flex justify-center space-x-4">
      <a
        :href="'/'"
        :class="[
          'font-bold-200 py-2 text-white custom-hover text-decoration-none me-3',
          { active: route.path === '/' }
        ]"
        >HOME</a
      >
      <a
        :href="'/about'"
        :class="[
          'font-bold-200 py-2 text-white custom-hover text-decoration-none me-3',
          { active: route.path === '/about' }
        ]"
        >ABOUT</a
      >
      <a
        :href="'/shop'"
        :class="[
          'font-bold-200 py-2 text-white custom-hover text-decoration-none me-3',
          { active: route.path === '/shop' }
        ]"
        >SHOP</a
      >
      <a
        :href="'/contact'"
        :class="[
          'font-bold-200 py-2 me-5 text-white custom-hover text-decoration-none me-5',
          { active: route.path === '/contact' }
        ]"
        >CONTACT</a
      >
    </nav>

    <!-- Authentication Button -->
    <div class="auth flex gap-2">
      <!-- Conditionally render Register, Login or Logout button -->
      <template v-if="!authStore.isAuthenticated">
        <a href="/register"
          ><button
            class="hover:bg-red-400 text-dark bg-white px-4 py-1 border-1 border-red-700 hover:border-red-500 rounded"
          >
            Register
          </button></a
        >
        <a href="/login"
          ><button
            class="hover:bg-red-400 text-dark bg-white px-4 py-1 border-1 border-red-700 hover:border-red-500 rounded"
          >
            Login
          </button></a
        >
      </template>
      <template v-else>
        <button
          @click="logout"
          class="hover:bg-red-400 text-dark bg-white px-4 py-1 border-1 border-red-700 hover:border-red-500 rounded"
        >
          Logout
        </button>
      </template>
    </div>

    <!-- Cart Button -->
    <button class="relative m-6 inline-flex w-fit">
      <div
        class="absolute bottom-auto left-auto right-0 top-0 z-10 inline-block -translate-y-1/2 translate-x-2/4 rotate-0 skew-x-0 skew-y-0 scale-x-100 scale-y-100 text-white rounded-full bg-red-600 py-1 px-2 text-sx"
      >
        1
      </div>
      <router-link
        to="/addtocart"
        class="flex items-center justify-center rounded-lg bg-primary-500 text-center text-white dark:text-gray-200"
      >
        <i class="bx bxs-cart-add text-4xl ml-4 text-white"></i>
      </router-link>
    </button>
  </header>
</template>

<script lang="ts">
import axios from "axios";
import { useRoute } from 'vue-router';
import { useAuthStore } from '@/stores/auth-store';

export default {
  setup() {
    const route = useRoute();
    const authStore = useAuthStore();
    return { route, authStore };
  },
  data(){
    return {
      // token: null, // Initialize token as null
    };
  },
  methods: {
    async logout() {
      this.authStore.logout();
      try {
        // Get the token from the auth store
        const token = this.authStore.token;
        if (token) {
          const userResponse = await axios.post('http://127.0.0.1:8000/api/logout', {
            headers: {
              Authorization: `Bearer ${token}`
            }
          });
            // Handle successful logout
            this.authStore.logout();
            this.$router.push('/');
            console.log('Logout successful');
        }
      } catch (error) {
        console.error('Logout failed', error);
      }
     },
    },
  
}

</script>

<style scoped>
.custom-hover {
  padding-bottom: 2px; /* Reduce bottom padding */
  line-height: 0.5; /* Set line height to 0.5 */
}

.custom-hover:hover {
  border-bottom: 2px solid white;
  border-radius: 5px;
}

.active {
  border-bottom: 2px solid white;
  border-radius: 5px;
  font-weight: bold; /* Optionally make the active link bold */
}

body {
  padding-top: 60px; /* Adjust based on navbar height to prevent content overlay */
}
</style>

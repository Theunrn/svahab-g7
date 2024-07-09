<template>
  <header
    style="padding-left: 60px; padding-right: 60px"
    class="flex justify-between py-2 items-center shadow-md navbar-light fixed top-0 left-0 right-0 bg-green-600 z-50"
  >
    <!-- Logo -->
    <div class="flex items-center space-x-2">
      <a href="/"><img width="33%" height="40%" src="../assets/image/logo.png" alt="Logo" /></a>
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
    <!-- Cart favorite -->
    <button class="relative inline-flex">
      <div  class="absolute top-0 right-0 transform translate-x-2/4 -translate-y-1/2 z-10 flex items-center justify-center h-5 w-5 bg-red-600 rounded-full text-white text-xs font-bold">
        1
      </div>
      <router-link to="" class="flex items-center justify-center rounded-lg bg-primary-500 text-white dark:text-gray-200">
        <i class='fa fa-heart-o text-2xl ml-4 text-white'></i> <!-- Larger cart icon -->
      </router-link>
    </button>
    <!-- Cart Button -->
    <button class="relative inline-flex w-fit mx-2">
      <div  class="absolute top-0 right-0 transform translate-x-2/4 -translate-y-1/2 z-10 flex items-center justify-center h-5 w-5 bg-red-600 rounded-full text-white text-xs font-bold">
        {{ itemCount }}
      </div>
      <router-link
        to="/addtocart"
        class="flex items-center justify-center rounded-lg bg-primary-500 text-white dark:text-gray-200"
      >
        <i class="bx bxs-cart-add text-3xl ml-4 text-white"></i>
        <!-- Larger cart icon -->
      </router-link>
    </button>
    <!-- Notification Button -->
    <button class="relative inline-flex w-fit mx-2" @click="clearNotifications">
      <div class="absolute top-0 right-0 transform translate-x-2/4 -translate-y-1/2 z-10 flex items-center justify-center h-5 w-5 bg-red-600 rounded-full text-white text-xs font-bold"
        v-if="notifications.length > 0">{{ getNewCount(notifications) }}
      </div>
      <router-link
        :to="{ path: '/notification/' + authStore.user.id }"
        class="flex items-center justify-center rounded-lg bg-primary-500 text-white dark:text-gray-200"
      >
        <i class="bx bx-bell text-3xl"></i>
        <!-- Larger bell icon -->
      </router-link>
    </button>
    <!-- History Button -->
    <button class="relative inline-flex items-center m-2 ">
      <router-link :to="{ path: '/history/' + authStore.user.id }" class="flex items-center justify-center rounded-lg bg-primary-500 text-white dark:text-gray-200">
        <span v-if="showText" class="absolute top-0 left-3/2 transform -translate-x-1/2 -translate-y-full text-lg font-semibold">History</span>
        <i class="bx bx-history text-3xl"
           @mouseover="showText = true"
           @mouseleave="showText = false"></i>
      </router-link>
    </button>
   <!-- Authentication Button -->
   <div class="auth flex gap-2">
      <!-- Conditionally render Register, Login or Logout button -->
      <template v-if="!authStore.isAuthenticated">
        <a href="/register"><button class="hover:bg-red-400 text-dark bg-white px-4 py-1 border-1 border-red-700 hover:border-red-500 rounded">Register</button></a>
        <a href="/login"><button class="hover:bg-red-400 text-dark bg-white px-4 py-1 border-1 border-red-700 hover:border-red-500 rounded">Login</button></a>
      </template>
      <template v-else>
			<div class="dropdown ms-1 ms-lg-0 " v-if="authStore.isAuthenticated">
				<a class="avatar avatar-sm p-0" href="#" id="profileDropdown" role="button" data-bs-auto-close="outside" data-bs-display="static" data-bs-toggle="dropdown" aria-expanded="false">
					<!-- <img class="avatar-img w-12 h-10 rounded-circle" src="../assets/image/liep.jpg" alt="avatar"> -->
          <i class='bx bxs-user-circle text-4xl text-white mt-2' ></i>
				</a>
				<ul class=" px-3 dropdown-menu dropdown-animation dropdown-menu-end shadow pt-3" aria-labelledby="profileDropdown">
					<!-- Profile info -->
					<li class="px-8" style="padding-left: 20px; padding-right: 20px;">
						<div class="d-flex align-items-center">
							<!-- Avatar -->
							<div class="me-3">
								<!-- <img class="avatar-img w-10 h-10 rounded-circle shadow" src="../assets/image/liep.jpg" alt="profiles"> -->
                <i class='bx bxs-user-circle text-4xl mt-2' ></i>
							</div>
							<div>
								<a class="h6" href="#">{{ authStore.user.name }}</a>
								<p class="small m-0">{{ authStore.user.email }}</p>
							</div>
						</div>
						<hr>
					</li>
					<!-- Links -->
					<li><a class="dropdown-item mt-2" href="../views/profiles/edit_profile.view.php">Edit Profile</a></li>
					<li><button class="dropdown-item bg-danger-soft-hover" @click="userLogout" >Sign Out</button></li>
				</ul>
			</div>
      </template>
    </div>
      
  </header>
</template>

<script setup lang="ts">
import { ref, computed, onMounted, reactive } from 'vue'
import { useRoute, useRouter } from 'vue-router'
import { useAuthStore } from '@/stores/auth-store'
import axiosInstance from '@/plugins/axios'

const route = useRoute()
const router = useRouter()
const authStore = useAuthStore()
const notifications = ref([])
const showDropdown = ref(false)
const showText = ref(false)

const fetchNotifications = async () => {
  try {
    const response = await axiosInstance.get(`/notifications/list/${authStore.user.id}`)
    notifications.value = response.data.data
  } catch (error) {
    console.error('Error fetching notifications:', error)
  }
}

const getNewCount = (notificationList) => {
  return notificationList.filter((notification) => !notification.read).length
}

const userLogout = () => {
  authStore.logout()
  // localStorage.removeItem('access_token')
  router.push('/')
}

const toggleDropdown = () => {
  showDropdown.value = !showDropdown.value
}

let itemCount = ref(0)

// Fetch cart items count
const fetchCartItemsCount = async () => {
  try {
    const response = await axiosInstance.get('http://127.0.0.1:8000/api/cart/list', {
      headers: {
        Authorization: `Bearer ${localStorage.getItem('access_token')}`
      }
    })
    if (response.data.success) {
      itemCount.value = response.data.data.reduce((total, item) => total + item.quantity, 0)
      // console.log(itemCount.value);
    } else {
      console.error('Failed to fetch cart items count')
    }
  } catch (error) {
    console.error('Error fetching cart items count:', error)
  }
}

onMounted(() => {
  fetchNotifications()
  fetchCartItemsCount()
})
</script>

<style scoped>
.custom-hover {
  padding-bottom: 2px;
  line-height: 0.5;
}

.custom-hover:hover {
  border-bottom: 2px solid white;
  border-radius: 5px;
}

.active {
  border-bottom: 2px solid white;
  border-radius: 5px;
  font-weight: bold;
}

body {
  padding-top: 60px;
}
</style>

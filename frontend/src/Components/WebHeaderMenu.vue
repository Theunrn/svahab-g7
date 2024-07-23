<template>
  <header
    style="padding-left: 50px; padding-right:50px;"
    class="flex justify-between py-3 items-center shadow-md navbar-light fixed top-0 left-0 right-0 bg-green-600 z-50"
  >
    <!-- Logo -->
    <div class="left">
      <a href="/"><img width="200" height="200" src="../assets/image/logo.png" alt="Logo" /></a>
    </div>
    <!-- Menu Items -->
    <nav class="flex center gap-5">
      <a
        :href="'/'" style="margin-left: 100px;"
        :class="[
          'font-bold-200 py-2 text-white custom-hover text-decoration-none',
          { active: route.path === '/' }
        ]"
        >HOME</a
      >
      <a
        :href="'/about'"
        :class="[
          'font-bold-200 py-2 text-white custom-hover text-decoration-none ',
          { active: route.path === '/about' }
        ]"
        >ABOUT</a
      >
      <a
        :href="'/shop'"
        :class="[
          'font-bold-200 py-2 text-white custom-hover text-decoration-none',
          { active: route.path === '/shop' }
        ]"
        >SHOP</a
      >
      <a
        :href="'/contact'"
        :class="[
          'font-bold-200 py-2 me-5 text-white custom-hover text-decoration-none ',
          { active: route.path === '/contact' }
        ]"
        >CONTACT</a
      >
    </nav>
    <div class=" right flex justify-center align-items-center">
      <!-- Cart Button -->
      <button class="relative inline-flex w-fit mx-3">
        <div
          class="absolute top-0 right-0 transform translate-x-2/4 -translate-y-1/2 z-10 flex items-center justify-center h-5 w-5 bg-red-600 rounded-full text-white text-xs font-bold"
        >
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
      <button class="relative inline-flex w-fit mx-3" @click="clearNotifications">
        <div
          class="absolute top-0 right-0 transform translate-x-2/4 -translate-y-1/2 z-10 flex items-center justify-center h-5 w-5 bg-red-600 rounded-full text-white text-xs font-bold"
          v-if="notifications.length > 0"
        >
          {{ getNewCount(notifications) }}
        </div>
        <div
          class="absolute top-0 right-0 transform translate-x-2/4 -translate-y-1/2 z-10 flex items-center justify-center h-5 w-5 bg-red-600 rounded-full text-white text-xs font-bold"
          v-else
        >
          0
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
      <button class="relative inline-flex items-center mx-3">
        <router-link
          :to="{ path: '/history/' + authStore.user.id }"
          class="flex items-center justify-center rounded-lg bg-primary-500 text-white dark:text-gray-200"
        >
          <span
            v-if="showText"
            class="absolute top-0 left-3/2 transform -translate-x-1/2 -translate-y-full text-lg font-semibold"
            >History</span
          >
          <i class="bx bx-history text-3xl"></i>
        </router-link>
      </button>
      <!-- Authentication Button -->
      <div class="auth flex gap-2">
        <!-- Conditionally render Register, Login or Logout button -->
        <div v-if="!authStore.isAuthenticated" class="flex gap-2 py-2">
          <a href="/login"
            ><button
              class="text-bold hover:bg-red-400 text-dark bg-white px-4 py-1 border-1 border-red-700 hover:border-red-500 rounded-md" style="border-radius: 50px; font-weight: bold;"
            >
              Sign in
            </button></a
          >
        </div>
        <template v-else>
          <div class="dropdown ms-1 ms-lg-0" v-if="authStore.isAuthenticated">
            <a
              class="avatar avatar-sm p-0"
              href="#"
              id="profileDropdown"
              role="button"
              data-bs-auto-close="outside"
              data-bs-display="static"
              data-bs-toggle="dropdown"
              aria-expanded="false"
            >
              <img class="w-10 h-10 rounded-full ring-2 ring-gray-300 dark:ring-gray-400" src="../assets/image/liep.jpg" alt="avatar">
              <!-- <i class="bx bxs-user-circle text-4xl text-white  "></i> -->
            </a>
            <ul
              class="px-3 dropdown-menu dropdown-animation dropdown-menu-end shadow pt-3"
              aria-labelledby="profileDropdown"
            >
              <!-- Profile info -->
              <li class="px-8" style="padding-left: 20px; padding-right: 20px">
                <div class="d-flex align-items-center">
                  <!-- Avatar -->
                  <div class="me-3">
                    <!-- <img class="avatar-img w-10 h-10 rounded-circle shadow" src="../assets/image/liep.jpg" alt="profiles"> -->
                    <i class="bx bxs-user-circle text-4xl mt-2"></i>
                  </div>
                  <div>
                    <a class="h6" href="#">{{ authStore.user.name }}</a>
                    <p class="small m-0">{{ authStore.user.email }}</p>
                  </div>
                </div>
                <hr />
              </li>
              <!-- Links -->
              <li>
                <button
                  class="dropdown-item mt-2"
                  type="button"
                  data-bs-toggle="modal"
                  data-bs-target="#exampleModal"
                >
                  Edit Profile
                </button>
              </li>
              <li>
                <button class="dropdown-item bg-danger-soft-hover" @click="userLogout">
                  Sign Out
                </button>
              </li>
            </ul>
          </div>
        </template>
      </div>
    </div>
  </header>
  <!-- Modal -->
  <div
    class="modal fade"
    id="exampleModal"
    tabindex="-1"
    aria-labelledby="exampleModalLabel"
    aria-hidden="true"
  >
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title text-2xl text-bold" id="exampleModalLabel">Update your profile</h5>
          <button
            type="button"
            class="btn-close"
            data-bs-dismiss="modal"
            aria-label="Close"
          ></button>
        </div>
        <div class="modal-body">
          <form>
            <div class="mb-3">
              <img
                v-if="profile !== null"
                width="150"
                height="150"
                :src="getImageUrl(profile)"
                :alt="profile"
              />
              <img
                v-else
                width="150"
                height="150"
                src="../assets/image/profile.png"
                :alt="profile"
              />
            </div>
            <div class="mb-3">
              <label for="exampleInputEmail1" class="form-label">Upload New profile *</label>
              <input
                type="file"
                class="form-control"
                id="exampleInputEmail1"
                aria-describedby="emailHelp"
              />
            </div>
            <div class="mb-3">
              <label for="exampleInputEmail1" class="form-label">Name *</label>
              <input
                type="text"
                class="form-control"
                id="exampleInputEmail1"
                aria-describedby="emailHelp"
                v-model="name"
              />
            </div>
            <div class="mb-3">
              <label for="exampleInputEmail1" class="form-label">Email *</label>
              <input
                type="email"
                class="form-control"
                id="exampleInputEmail1"
                aria-describedby="emailHelp"
                v-model="email"
              />
            </div>
            <button type="button" class="btn btn-primary">Save changes</button>
          </form>
        </div>
      </div>
    </div>
  </div>
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
const name = ref('')
const email = ref('')
const profile = ref('')

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
  name.value = authStore.user.name
  email.value = authStore.user.email
  profile.value = authStore.user.profile
})
const getImageUrl = (imagePath) => {
  const image = imagePath
    ? `http://127.0.0.1:8000/public/images/${imagePath}`
    : '/default-image.jpg'
}
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

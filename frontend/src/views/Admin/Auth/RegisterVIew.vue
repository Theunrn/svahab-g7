<template>
  <div class="bg-gray-100 flex items-center justify-center min-h-screen">
    <div class="w-full max-w-md bg-white rounded-lg shadow-md p-8">
      <h2 class="text-2xl font-bold mb-6 text-center text-black">Registration Form</h2>
      <form @submit.prevent="createCustomer" class="space-y-6">
        <div>
          <label for="fullName" class="block text-sm font-medium text-gray-700">Full Name</label>
          <input
            type="text"
            id="fullName"
            v-model="name"
            required
            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
          />
        </div>
        <div>
          <label for="phoneNumber" class="block text-sm font-medium text-gray-700"
            >Phone Number</label
          >
          <input
            type="text"
            id="phoneNumber"
            v-model="phone_number"
            required
            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
          />
        </div>
        <div>
          <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
          <input
            type="email"
            id="email"
            v-model="email"
            required
            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
          />
        </div>
        <div class="relative">
          <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
          <input
            :type="passwordVisible ? 'text' : 'password'"
            id="password"
            v-model="password"
            required
            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm pr-10"
          />
          <span
            class="absolute inset-y-0 right-0 flex items-center px-3 cursor-pointer text-center mt-4"
            @click="togglePasswordVisibility"
          >
            <i
              :class="
                passwordVisible ? 'bx bx-show text-gray-500' : 'bx bx-low-vision text-gray-500' 
              "
            ></i>
          </span>
        </div>

        <div>
          <button
            type="submit"
            class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
          >
            Register
          </button>
        </div>
      </form>
    </div>
  </div>
</template>

<script>
import axios from 'axios'
import bcrypt from 'bcryptjs'
import { useRouter } from 'vue-router'
import { ref } from 'vue'
import { useAuthStore } from '@/stores/auth-store'

const authStore = useAuthStore()

export default {
  data() {
    return {
      customers: [],
      name: '',
      phone_number: '',
      email: '',
      password: '',
      passwordVisible: false
    }
  },
  setup() {
    const router = useRouter()
    return { router }
  },
  methods: {
    togglePasswordVisibility() {
      this.passwordVisible = !this.passwordVisible
    },
    async createCustomer() {
      try {
        const hashedPassword = await bcrypt.hash(this.password, 10)

        // Register the customer
        const response = await axios.post('http://127.0.0.1:8000/api/register', {
          name: this.name,
          email: this.email,
          password: hashedPassword,
          phone_number: this.phone_number
        })
        const token = response.data.access_token
        // Fetch user details using the token
        const userResponse = await axios.get('http://127.0.0.1:8000/api/user', {
          headers: {
            Authorization: `Bearer ${token}`
          }
        })
        const customerId = userResponse.data.id
        // Update the role to 'customer'
        await axios.put(
          `http://127.0.0.1:8000/api/customers/${customerId}/role`,
          {
            role: 'customer'
          },
          {
            headers: {
              Authorization: `Bearer ${token}`
            }
          }
        )
        this.customers = response.data
        // Display success message
        alert('Customer registered and role updated successfully')

        localStorage.setItem('access_token', token)
        this.router.push('/')
      } catch (error) {
        if (error.response) {
          console.error('API Error:', error.response.data)
        } else {
          alert('Failed to register')
          console.error('Error:', error.message)
        }
      }
    }
  }
}
</script>

<style>
/* No custom styles needed, using only Tailwind CSS */
</style>

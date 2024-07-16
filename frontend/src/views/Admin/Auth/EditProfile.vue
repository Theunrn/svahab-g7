<template>
    <div class="bg-gray-100 flex items-center justify-center h-screen">
      <div class="w-full max-w-md bg-white rounded-lg shadow-md p-8">
        <h2 class="text-2xl font-bold mb-6 text-center">Registration Form</h2>
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
            <label for="phoneNumber" class="block text-sm font-medium text-gray-700">Phone Number</label>
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
          <div>
            <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
            <input
              type="password"
              id="password"
              v-model="password"
              required
              class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
            />
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
  import axios from 'axios';
  import bcrypt from 'bcryptjs';
  import { useRouter } from 'vue-router';
  
  export default {
    data() {
      return {
        customers: [],
        name: '',
        phone_number: '',
        email: '',
        password: '',
      };
    },
    setup() {
      const router = useRouter();
      return { router };
    },
    methods: {
      async createCustomer() {
        try {
          const hashedPassword = await bcrypt.hash(this.password, 10);
  
          // Register the customer
          const response = await axios.post('http://127.0.0.1:8000/api/register', {
            name: this.name,
            email: this.email,
            password: hashedPassword,
            phone_number: this.phone_number,
          });
  
          const token = response.data.access_token;
          // Fetch user details using the token
          const userResponse = await axios.get('http://127.0.0.1:8000/api/user', {
            headers: {
              Authorization: `Bearer ${token}`
            }
          });
          const customerId = userResponse.data.id;
          // Update the role to 'customer'
          const roleUpdateResponse = await axios.put(`http://127.0.0.1:8000/api/customers/${customerId}/role`, {
            role: 'customer'
          }, {
            headers: {
              Authorization: `Bearer ${token}`
            }
          });
          this.customers = response.data;
          // Display success message
          alert('Customer registered and role updated successfully');
  
          // Redirect to home page
          this.router.push({ path: '/' });
        } catch (error) {
          if (error.response) {
            console.error('API Error:', error.response.data);
          } else {
            console.error('Error:', error.message);
          }
        }
      },
    },
  };
  
  </script>
  
  <style>
  /* You can add custom styles here if needed */
  </style>
  
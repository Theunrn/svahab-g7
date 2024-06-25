<template>
  <div class="bg-gray-100 flex items-center justify-center h-screen">
    <div class="w-full max-w-md bg-white rounded-lg shadow-md p-8">
      <h2 class="text-2xl font-bold mb-6 text-center">Registration Form</h2>
      <form @submit.prevent="createCustomer" class="space-y-6">
        <!-- Form fields (name, phone_number, email, password) -->
      </form>
    </div>
  </div>
</template>

<script lang="ts">
import axiosInstance from '@/plugins/axios';
import bcrypt from 'bcryptjs';
import { useRouter } from 'vue-router';

export default {
  data() {
    return {
      name: '',
      phone_number: '',
      email: '',
      password: '',
    };
  },
  setup() {
    const router = useRouter();

    const createCustomer = async () => {
      try {
        // Hash password
        const hashedPassword = await bcrypt.hash(this.password, 10);

        // Register the customer
        const registerResponse = await axiosInstance.post('/register', {
          name: this.name,
          email: this.email,
          password: hashedPassword,
          phone_number: this.phone_number,
        });

        // Extract access token from response
        const token = registerResponse.data.access_token;

        // Fetch user details using the token
        const userResponse = await axiosInstance.get('/user', {
          headers: {
            Authorization: `Bearer ${token}`
          }
        });

        // Extract user ID from response
        const customerId = userResponse.data.id;

        // Update the role to 'customer'
        await axiosInstance.put(`/customers/${customerId}/role`, {
          role: 'customer'
        }, {
          headers: {
            Authorization: `Bearer ${token}`
          }
        });

        // Display success message
        alert('Customer registered and role updated successfully');

        // Redirect to home page
        router.push({ path: '/' });

      } catch (error) {
        if (error.response) {
          console.error('API Error:', error.response.data);
        } else {
          console.error('Error:', error.message);
        }
      }
    };

    return {
      createCustomer
    };
  }
};
</script>

<style>
/* You can add custom styles here if needed */
</style>

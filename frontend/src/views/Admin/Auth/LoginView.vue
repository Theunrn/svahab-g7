<template>
  <div class="flex items-center justify-center min-h-screen bg-gray-100">
    <el-card class="w-full max-w-md shadow-lg">
      <h2 class="text-2xl font-bold mb-6 text-center">Login</h2>
      <el-form @submit.prevent="onSubmit">
        <el-form-item :error="emailError">
          <el-input placeholder="Email Address" v-model="email" size="large" />
        </el-form-item>

        <el-form-item :error="passwordError" class="mt-8 relative">
          <el-input
            :placeholder="'Password'"
            v-model="password"
            :size="'large'"
            :type="passwordVisible ? 'text' : 'password'"
          />
          <span
            class="absolute inset-y-0 right-0 pr-3 flex items-center cursor-pointer"
            @click="togglePasswordVisibility"
          >
            <i :class="passwordVisible ? 'fa fa-eye' : 'fa fa-eye-slash'"></i>
          </span>
        </el-form-item>

        <div>
          <el-button
            size="large"
            class="mt-3 w-full"
            :disabled="isSubmitting"
            type="primary"
            native-type="submit"
            >Submit</el-button
          >
        </div>

        <p class="text-sm font-light text-gray-500 dark:text-gray-400 mt-2">
          Doesn't have an account yet?
          <a
            href="/register"
            class="font-medium text-blue-600 hover:underline dark:text-primary-500"
            >Create account</a
          >
        </p>
      </el-form>
    </el-card>
  </div>
</template>

<script setup lang="ts">
import axiosInstance from '@/plugins/axios'
import { useField, useForm } from 'vee-validate'
import * as yup from 'yup'
import { useRouter } from 'vue-router'
import { ref } from 'vue'

const router = useRouter()
const emailError = ref('')
const passwordError = ref('')
const formSchema = yup.object({
  password: yup.string().required().label('Password'),
  email: yup.string().required().email().label('Email address')
})

const { handleSubmit, isSubmitting } = useForm({
  initialValues: {
    password: '',
    email: ''
  },
  validationSchema: formSchema
})

const onSubmit = handleSubmit(async (values) => {
  try {
    const { data } = await axiosInstance.post('/login', values)
    localStorage.setItem('access_token', data.access_token)
    router.push('/')
  } catch (error) {
    // Handle specific error messages
    if (error.response.status === 401) {
      // Assuming 401 status for incorrect password or user not found
      if (error.response.data.message.includes('User not found')) {
        emailError.value = 'User not found'
      } else if (error.response.data.message.includes('Incorrect password')) {
        passwordError.value = 'Password is not correct'
      }
    } else {
      console.warn('Error:', error)
    }
  }
})

const { value: password, errorMessage: passwordFieldError } = useField('password')
const { value: email, errorMessage: emailFieldError } = useField('email')

const passwordVisible = ref(false)
const togglePasswordVisibility = () => {
  passwordVisible.value = !passwordVisible.value
}
</script>

<style scoped>
.min-h-screen {
  min-height: 100vh;
}
.absolute {
  position: absolute;
}
.inset-y-0 {
  top: 0;
  bottom: 0;
}
.right-0 {
  right: 0;
}
.pr-3 {
  padding-right: 0.75rem;
}
.cursor-pointer {
  cursor: pointer;
}
</style>

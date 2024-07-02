import { defineStore } from 'pinia'
import { ref } from 'vue'

export const useAuthStore = defineStore('auth', () => {
  const user = ref()
  const isAuthenticated = ref(false)
  const permissions = ref()
  const roles = ref()

  function login() {
    isAuthenticated.value = true;
  }

  function logout() {
    isAuthenticated.value = false;
  }
  return {
    user,
    roles,
    permissions,
    isAuthenticated,
    login,
    logout
  }
})

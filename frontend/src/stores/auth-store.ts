import { defineStore } from 'pinia';
import { ref, watch } from 'vue';

export const useAuthStore = defineStore('auth', () => {
  const user = ref(null);
  const isAuthenticated = ref(false); // Start with isAuthenticated as false initially
  const permissions = ref([]);
  const roles = ref([]);

  function login(userInfo) {
    user.value = userInfo;
    isAuthenticated.value = true;
    localStorage.setItem('isAuthenticated', 'true');
    localStorage.setItem('user', JSON.stringify(userInfo));
  }

  function logout() {
    user.value = null;
    isAuthenticated.value = false;
    localStorage.removeItem('isAuthenticated');
    localStorage.removeItem('user');
  }

  function initialize() {
    const storedUser = localStorage.getItem('user');
    if (storedUser) {
      user.value = JSON.parse(storedUser);
      isAuthenticated.value = true; // Only set isAuthenticated to true if there is a stored user
    }
  }

  watch(isAuthenticated, (newVal) => {
    if (!newVal) {
      user.value = null;
    }
  });

  return {
    user,
    roles,
    permissions,
    isAuthenticated,
    login,
    logout,
    initialize,
  };
});

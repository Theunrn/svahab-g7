import { defineStore } from 'pinia';

export const useAuthStore = defineStore('auth', {
  state: () => ({
    user: null,
    isAuthenticated: false,
    permissions: [],
    roles: [],
    token: null, // Add token state
  }),

  actions: {
    setUserAndToken(user, token) {
      this.user = user;
      this.setToken(token);
    },

    setToken(token) {
      this.token = token;
      this.isAuthenticated = !!token;
      // Update localStorage with the token
      localStorage.setItem('access_token', token);
    },

    getToken() {
      return this.token;
    },

    logout() {
      this.user = null;
      this.isAuthenticated = false;
      this.token = null;
      localStorage.removeItem('access_token'); // Remove token from localStorage
      // Perform any other cleanup or API calls for logout
    },
    register(user){
      this.isAuthenticated = true;
      this.user = user;
      
    }
  },
  persist: {
    enabled: true,
    strategies: [
      {
        key: 'auth',
        storage: localStorage,
      },
    ],
  },
});

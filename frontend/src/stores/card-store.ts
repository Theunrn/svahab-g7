import { defineStore } from 'pinia'
import { ref } from 'vue'

export const useCartStore = defineStore('cart', {
    state: () => ({
        items: []
    }),
    getters: {
        itemCount: (state) => state.items.length,
        totalProductCount: (state) => state.items.reduce((total, item) => total + item.quantity, 0)
    },
    actions: {
        async fetchCartItems() {
            try {
                const response = await axios.get('http://127.0.0.1:8000/api/cart/list', {
                    headers: {
                        Authorization: `Bearer ${localStorage.getItem('access_token')}`
                    }
                });
                if (response.data.success) {
                    this.items = response.data.data;
                    console.log(items);
                } else {
                    console.error('Failed to fetch cart items');
                }


            } catch (error) {
                console.error('Error fetching cart items:', error);
            }
        },
        addItem(product) {
            this.items.push(product);
        },
        removeItem(productId) {
            this.items = this.items.filter(item => item.id !== productId);
        },
        clearCart() {
            this.items = [];
        }
    }
    
});

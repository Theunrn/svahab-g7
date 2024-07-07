import { defineStore } from 'pinia';

export const useOrderStore = defineStore('order', {
  state: () => ({
    orderId: null as number | null,
  }),
  actions: {
    setOrderId(orderId: number) {
      this.orderId = orderId;
    },
    clearOrderId() {
      this.orderId = null;
    },
  },
});
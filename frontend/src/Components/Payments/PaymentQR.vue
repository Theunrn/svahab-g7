<template>
  <div class="container flex justify-center" style="padding: 0px 100px 0px 100px">
    <div
      class="left w-50 text-white bg-gradient-to-r from-teal-400 via-teal-500 to-teal-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-teal-300 dark:focus:ring-teal-800 font-medium rounded-lg text-sm text-center flex justify-center align-center flex-column gap-2"
      style="padding: 50px"
    >
      <div class="top">
        <p class="text-white text-2xl">You are paying</p>
        <hr />
        <h1 class="text-5xl text-white text-bold p-3" style="font-weight: bold">
          ${{ total_price }}
        </h1>
        <hr />
        <p class="text-white text-2xl">Cambodia</p>
      </div>
    </div>
    <div
      class="right bg-white w-50"
      style="display: flex; justify-content: center; align-items: center; flex-direction: column"
    >
      <div class="info">
        <h1
          class="font-bold text-center text-4xl text-yellow-500 mt-3"
          style="font-family: fantasy"
        >
          S<span class="text-dark">vahab</span>
        </h1>
      </div>
      <div class="w-full max-w-sm p-4 rounded-lg dark:bg-gray-800 dark-gray-700">
        <div
          class="flex justify-center rounded-md flex-column text-center text-white bg-gradient-to-r from-green-400 via-green-500 to-green-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-green-300 dark:focus:ring-green-800 font-medium rounded-lg text-sm text-center p-2"
        >
          <img class="px-2 rounded-md" :src="image" alt="QR image" />
          <p class="text-bold text-white">Owner Name QR</p>
        </div>
      </div>
      <div
        class="px-5 pb-5 gap-3"
        style="display: flex; justify-content: center; flex-direction: column; align-items: center"
      >
        <div class="flex flex-column justify-center text-center w-full">
          <h1 class="w-100" style="font-weight: bold; font-size: 15px">
            Scan this QR now to get your order successfully
          </h1>
          <h1 class="w-100" style="font-size: 12px">
            Before you click confirm please scan QR above
          </h1>
        </div>
        <button
          @click="submitPayment"
          type="button"
          class="text-white w-50 bg-gradient-to-r from-green-400 via-green-500 to-green-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-green-300 dark:focus:ring-green-800 font-medium rounded-md text-sm px-8 py-2.5 text-center me-2 mb-2"
        >
          Confirm Paying
        </button>
      </div>
    </div>
  </div>
</template>
<script>
import axios from 'axios'

export default {
  data() {
    return {
      isPaid: false,
      bookingId: null,
      total_price: '00.00',
      userId: null,
      ownerId: null,
      paymentDate: null,
      field_id: null,
      product_id: null,
      token: null,
      qr: null,
      image: null,
    }
  },
  async mounted() {
    this.bookingId = this.$route.query.booking
    this.orderId = localStorage.getItem('orderId')
    this.userId = this.$route.params.id
    this.paymentDate = new Date().toISOString().split('T')[0]
    if (this.bookingId) {
      await this.fetchBooking()
    }
    if (this.field_id) {
      await this.fetchFieldOwner()
    }
    if (this.orderId) {
      await this.fetchOrder()
    }
    if(this.product_id){
      await this.fetchProductOwner()
    }
    if(this.ownerId){
      await this.fetchOwner()
    }
    if(this.qr){
      await this.getImageUrl()
    }
  },
  methods: {
    generateRandomCode(length) {
      const min = Math.pow(10, length - 1)
      const max = Math.pow(10, length) - 1
      return Math.floor(Math.random() * (max - min + 1)) + min
    },

    async submitPayment() {
      try {
        // Create a Payment Intent on the backend
        const { data } = await axios.post('http://127.0.0.1:8000/api/payment/create', {
          user_id: this.userId,
          owner_id: this.ownerId,
          amount: this.total_price, // Use total_price as amount
          method: 'QR',
          currency: 'USD',
          code: this.generateRandomCode(9),
          payment_date: this.paymentDate
        })
        this.isPaid = true
        localStorage.removeItem('orderId')
        this.updatePaymentStatus()
        alert('Payment successful')
        
      } catch (error) {
        alert('Failed creating payment')
        console.error('Error creating payment intent:', error)
      }
    },

    async updatePaymentStatus() {
      if (this.isPaid) {
        try {
          if (this.bookingId) {
            const { data } = await axios.put(
              `http://127.0.0.1:8000/api/update/payment/booking/${this.bookingId}`
            )
            console.log('Payment status in booking updated successfully')
          }
          else if (this.orderId) {
            const { data } = await axios.put(
              `http://127.0.0.1:8000/api/update/payment/order/${this.orderId}`
            )
            console.log('Payment status in order updated successfully')
          }
          this.$router.push({ path: '/' })
        } catch (error) {
          console.error('Error updating payment status:', error)
        }
      }
    },

    async fetchBooking() {
      try {
        const { data } = await axios.get(`http://127.0.0.1:8000/api/booking/show/${this.bookingId}`)
        this.total_price = data.data.total_price
        this.field_id = data.data.field_id
      } catch (error) {
        console.error('Error fetching booking data:', error)
      }
    },
    async fetchFieldOwner() {
      try {
        const { data } = await axios.get(`http://127.0.0.1:8000/api/field/show/${this.field_id}`)
        this.ownerId = data.data.owner_id
      } catch (error) {
        console.error('Error fetching owner data:', error)
      }
    },
    async fetchOrder() {
      try {
        const { data } = await axios.get(`http://127.0.0.1:8000/api/orders/show/${this.orderId}`, {
          headers: {
            Authorization: `Bearer ${this.token}`
          }
        })

        this.total_price = data.data.total_amount
        this.product_id = data.data.products[0].id
      } catch (error) {
        console.error('Error fetching order data:', error)
      }
    },
    async fetchProductOwner() {
      try {
        const { data } = await axios.get(`http://127.0.0.1:8000/api/product/show/${this.product_id}`)
        this.ownerId = data.data.owner_id
      } catch (error) {
        console.error('Error fetching product owner data:', error)
      }
    },
    async fetchOwner() {
      try {
        const { data } = await axios.get(`http://127.0.0.1:8000/api/owner/show/${this.ownerId}`)
        this.qr = data.data.qr;
      } catch (error) {
        console.error('Error fetching product owner data:', error)
      }
    },
    async getImageUrl()  {
       this.image = `http://127.0.0.1:8000${this.qr}`     
    }
  }
}
</script>

<style scoped>
</style>

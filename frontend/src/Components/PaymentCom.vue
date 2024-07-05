<template>
  <div id="app" class="container mt-5">
    <form @submit.prevent="submitPayment" id="payment-form">
      <div class="form-group">
        <label for="amount">Amount ($)</label>
        <input type="number" id="amount" v-model="amount" class="form-control" required />
      </div>
      <div id="card-element" class="form-control">
        <!-- Stripe Card Element will be inserted here -->
      </div>
      <button type="submit" class="btn btn-primary mt-3">Pay Now</button>
      <div id="card-errors" role="alert" class="text-danger mt-2"></div>
    </form>
  </div>
</template>
  
<script>
import { loadStripe } from '@stripe/stripe-js'
import axios from 'axios'

export default {
  data() {
    return {
      stripe: null,
      elements: null,
      cardElement: null,
      amount: 0,
      isPaid: false,
      bookingId: null,
    }
  },
  async mounted() {
    // Get bookingId from query parameters
    this.bookingId = this.$route.query.bookingId

    // Load Stripe
    this.stripe = await loadStripe(
      'pk_test_51PY0rM2LbQW9hazpTrN6pOrbmkotW9UrQkyEAW9YojtC3VyakwQmUqqN3EJgG2yjLoEH1lo54bKdrJK35ZQ1sK0E00Vv0cUxjY'
    ) // Replace with your publishable key

    // Create an instance of Elements
    this.elements = this.stripe.elements()

    // Create a Card Element and mount it to the #card-element div
    this.cardElement = this.elements.create('card', {
      style: {
        base: {
          iconColor: '#666EE8',
          color: '#31325F',
          fontWeight: 400,
          fontFamily: 'Helvetica Neue, Helvetica, Arial, sans-serif',
          fontSize: '16px',
          '::placeholder': {
            color: '#CFD7E0'
          }
        }
      }
    })
    this.cardElement.mount('#card-element')

    // Handle real-time validation errors from the card Element
    this.cardElement.on('change', (event) => {
      const displayError = document.getElementById('card-errors')
      if (event.error) {
        displayError.textContent = event.error.message
      } else {
        displayError.textContent = ''
      }
    })
  },
  methods: {
    async submitPayment() {
      try {
        // Create a Payment Intent on the backend
        const { data } = await axios.post('http://127.0.0.1:8000/api/stripe/payment', {
          amount: this.amount * 100 // Convert amount to cents
        })

        // Confirm the Card Payment
        const { error, paymentIntent } = await this.stripe.confirmCardPayment(data.clientSecret, {
          payment_method: {
            card: this.cardElement
          }
        })

        if (error) {
          // Show error to your customer
          console.error(error.message)
          const displayError = document.getElementById('card-errors')
          displayError.textContent = error.message
        } else {
          if (paymentIntent.status === 'succeeded') {
            console.log('Payment succeeded:', paymentIntent)
            this.isPaid = true
            alert('Payment succeeded!')
            // Update payment status
            await this.updatePaymentStatus()
            // Redirect to home page
            this.$router.push({ path: '/' })
          }
        }
      } catch (error) {
        console.error('Error creating payment intent:', error)
      }
    },
    async updatePaymentStatus() {
      if (this.isPaid) {
        try {
          const { data } = await axios.get(
            `http://127.0.0.1:8000/api/update/payment/booking/${this.bookingId}`
          )
          console.log('Payment status in booking updated successfully')
          this.$router.push({ path: '/' })

        } catch (error) {
          console.error('Error fetching payment status:', error)
        }
      }
    }
  }
}
</script>

  <style>
#card-element {
  border: 1px solid #ced4da;
  padding: 10px;
  border-radius: 4px;
}
#payment-form {
  max-width: 500px;
  margin: auto;
}
</style>
  
<template>
    <div class="container w-50 p-2 bg-white border border-gray-200 rounded-lg shadow sm:p-6 md:p-8 dark:bg-gray-800 dark:border-gray-700" style="margin-top: 100px; margin-bottom: 50px;">
      <!-- <h1 class="text-2xl font-bold text-gray-800 m-3 dark:text-gray-100">Payment Form <i class='bx bxl-visa text-4xl'></i></h1><hr> -->
      <div class="flex text-center justify-center">
        <h1 class="text-3xl font-bold text-gray-800 m-3 dark:text-gray-100">Payment Form </h1>
        <img class="w-13 h-8 mt-3" src="https://lh6.googleusercontent.com/proxy/T8fjld7xQK5zAxSh8SfzGOT7Ufidp8BZcHByP9_Bl3r-opUtdBHT_Ws7XoOkKkb7mloIy-U3GQEr_dhFYg8Sjosli8qBKIY6HA" alt="">
        <hr>
      </div>
      <form @submit.prevent="submitPayment" id="payment-form">
        <div class="form-group mt-3">
          <label for="email">Email *</label>
          <input type="email" id="email" v-model="email" class="form-control" placeholder="xxxxxx@gmail.com" required />
        </div>
        <div class="form-group mt-3">
          <label for="name">Name on Card</label>
          <input type="text" id="name" v-model="name" class="form-control" required />
        </div>
        <div class="form-group mt-3">
          <label for="total">Total booking ($) *</label>
          <input type="number" id="total" v-model="total_price" class="form-control" required disabled />
        </div>
        <div class="form-group mt-3">
          <label for="amount">Amount ($) *</label>
          <input type="number" id="amount" v-model="amount" class="form-control" required />
        </div>
        <div class="form-group mt-3">
          <label for="card-element">Card Information</label>
          <div id="card-element" class="form-control">
            <div id="card-number" class="form-control">
              
            </div>
            <div class="row mt-2">
              <div class="col-md-4">
                <div id="card-expiry" class="form-control"></div>
              </div>
              <div class="col-md-4">
                <div id="card-cvc" class="form-control"></div>
              </div>
              <div class="col-md-4">
                <input type="text" id="postal-code" v-model="postalCode" class="form-control" placeholder="ZIP" required />
              </div>
            </div>
          </div>
        </div>
        <button type="submit" class="btn btn-primary mt-3">Pay Now</button>
        <div id="card-errors" role="alert" class="text-danger mt-2"></div>
      </form>
  </div>
  
  </template>
  
  <script>
  import { loadStripe } from '@stripe/stripe-js';
  import axios from "axios";
  
  export default {
    data() {
      return {
        stripe: null,
        elements: null,
        cardNumber: null,
        cardExpiry: null,
        cardCvc: null,
        email: '',
        name: '',
        amount: 0,
        postalCode: '',
        isPaid: false,
        bookingId: null,
        total_price: '00.00',
      };
    },
    async mounted() {
      this.bookingId = this.$route.query.booking;
      if (this.bookingId) {
        await this.fetchBooking();
      }
  
      this.stripe = await loadStripe('pk_test_51PY0rM2LbQW9hazpTrN6pOrbmkotW9UrQkyEAW9YojtC3VyakwQmUqqN3EJgG2yjLoEH1lo54bKdrJK35ZQ1sK0E00Vv0cUxjY'); // Replace with your publishable key
  
      this.elements = this.stripe.elements();
  
      this.cardNumber = this.elements.create('cardNumber', {
        style: {
          base: {
            iconColor: '#666EE8',
            color: '#31325F',
            fontWeight: 400,
            fontFamily: 'Helvetica Neue, Helvetica, Arial, sans-serif',
            fontSize: '16px',
            '::placeholder': {
              color: '#CFD7E0',
            },
          },
        },
      });
      this.cardNumber.mount('#card-number');
  
      this.cardExpiry = this.elements.create('cardExpiry', {
        style: {
          base: {
            iconColor: '#666EE8',
            color: '#31325F',
            fontWeight: 400,
            fontFamily: 'Helvetica Neue, Helvetica, Arial, sans-serif',
            fontSize: '16px',
            '::placeholder': {
              color: '#CFD7E0',
            },
          },
        },
      });
      this.cardExpiry.mount('#card-expiry');
  
      this.cardCvc = this.elements.create('cardCvc', {
        style: {
          base: {
            iconColor: '#666EE8',
            color: '#31325F',
            fontWeight: 400,
            fontFamily: 'Helvetica Neue, Helvetica, Arial, sans-serif',
            fontSize: '16px',
            '::placeholder': {            color: '#CFD7E0',
            },
          },
        },
      });
      this.cardCvc.mount('#card-cvc');
  
      // Event listeners for real-time validation errors
      this.cardNumber.on('change', (event) => {
        const displayError = document.getElementById('card-errors');
        if (event.error) {
          displayError.textContent = event.error.message;
        } else {
          displayError.textContent = '';
        }
      });
  
      this.cardExpiry.on('change', (event) => {
        const displayError = document.getElementById('card-errors');
        if (event.error) {
          displayError.textContent = event.error.message;
        } else {
          displayError.textContent = '';
        }
      });
  
      this.cardCvc.on('change', (event) => {
        const displayError = document.getElementById('card-errors');
        if (event.error) {
          displayError.textContent = event.error.message;
        } else {
          displayError.textContent = '';
        }
      });
    },
    methods: {
      async submitPayment() {
        try {
          // Create a Payment Intent on the backend
          const { data } = await axios.post('http://127.0.0.1:8000/api/stripe/payment', {
            amount: this.amount * 100, // Convert amount to cents
          });
  
          // Confirm the Card Payment
          const { error, paymentIntent } = await this.stripe.confirmCardPayment(data.clientSecret, {
            payment_method: {
              card: this.cardNumber,
              billing_details: {
                name: this.name,
                email: this.email,
                address: {
                  postal_code: this.postalCode
                }
              },
            }
          });
  
          if (error) {
            // Show error to your customer
            console.error(error.message);
            const displayError = document.getElementById('card-errors');
            displayError.textContent = error.message;
          } else {
            if (paymentIntent.status === 'succeeded') {
              this.isPaid = true;
              console.log('Payment succeeded:', paymentIntent);
              // Show a success message to your customer
              alert('Payment succeeded!');
              await this.updatePaymentStatus()
            }
          }
        } catch (error) {
          console.error('Error creating payment intent:', error);
        }
        
      },
      async updatePaymentStatus() {
        if (this.isPaid) {
          try {
            const { data } = await axios.put(
              `http://127.0.0.1:8000/api/update/payment/booking/${this.bookingId}`
            )
            console.log('Payment status in booking updated successfully')
            this.$router.push({ path: '/' })
  
          } catch (error) {
            console.error('Error fetching payment status:', error)
          }
        }
      },
      async fetchBooking() {
        try {
          const { data } = await axios.get(
            `http://127.0.0.1:8000/api/booking/show/${this.bookingId}`
          )
          this.total_price = data.data.total_price;
        } catch (error) {
          console.error('Error fetching booking data:', error)
        }
      }
    }
  };
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
  
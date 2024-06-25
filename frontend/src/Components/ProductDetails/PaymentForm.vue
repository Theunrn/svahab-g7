<template>
    
    <div class="form-container">
      <div class="container" >
        <div class="form-header">
          <h1>Summary</h1>
        </div>
        <table class="product-details mt-3">
          <thead>
            <tr>
              <th>Product</th>
              <th>Total</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <th><img src="../../assets/ShopImage/card/ball.png" class="product-img" alt="Football ball"></th>
              <td>3.3$</td>
            </tr>
            <tr>
              <th>Subtotal</th>
              <td>3.3$</td>
            </tr>
            <tr>
              <th>Shipping</th>
              <td>4$</td>
            </tr>
            <tr>
              <th>Order Total</th>
              <td>7.3$</td>
            </tr>
          </tbody>
        </table>
      </div>
      
      <form>
        <div class="form-header">
          <h1 class="m-4">Checkout</h1>
        </div>
        <div class="success-message"></div>
        <div class="form-group">
          <label for="firstName">Full Name *</label>
          <div class="name-container">
            <input type="text" id="firstName" v-model="form.firstName" class="half-width" placeholder="First Name" required>
            <input type="text" id="lastName" v-model="form.lastName" class="half-width" placeholder="Last Name" required>
          </div>
        </div>
        <div class="form-group">
          <label for="email">E-mail *</label>
          <input type="email" id="email" v-model="form.email" placeholder="example@example.com" required>
        </div>
        <div class="form-group">
          <label for="phoneNumber">Phone Number *</label>
          <input type="tel" id="phoneNumber" v-model="form.phoneNumber" placeholder="123-456-7890" required>
        </div>
        <div class="form-group">
          <label for="phoneNumber">Address *</label>
          <input type="tel" id="phoneNumber" v-model="form.address" placeholder="123-456-7890" required>
        </div>
        <div class="form-group">
          <label for="comments">Comments</label>
          <textarea id="comments" v-model="form.comments" rows="4"></textarea>
        </div>
        <div class="form-group">
          <label>Payment Methods *</label>
          <div class="payment-methods">
            <div class="payment-option">
              <input type="radio" id="creditCard" value="creditCard" v-model="form.paymentMethod" required>
              <label for="creditCard">Debit or Credit Card</label>
            </div>
            <div class="payment-option">
              <input type="radio" id="paypal" value="paypal" v-model="form.paymentMethod">
              <label for="paypal">PayPal</label>
            </div>
          </div>
        </div>
        <div v-if="form.paymentMethod === 'creditCard'">
          <div class="form-group">
            <label for="ccFirstName">Full Name *</label>
            <div class="name-container">
              <input type="text" id="ccFirstName" v-model="form.ccFirstName" class="half-width" placeholder="First Name" required>
              <input type="text" id="ccLastName" v-model="form.ccLastName" class="half-width" placeholder="Last Name" required>
            </div>
          </div>
          <div class="form-group">
            <label for="ccNumber">Credit Card Number *</label>
            <input type="text" id="ccNumber" v-model="form.ccNumber" placeholder="please inter your address" required>
          </div>
          <div class="form-group">
            <label for="ccExpiration">Card Expiration *</label>
            <div class="expiration-container">
              <input type="month" id="ccExpiration" v-model="form.ccExpiration" required>
              <label for="ccCVC" class="half-width">CVC *</label>
              <input type="text" id="ccCVC" v-model="form.ccCVC" class="half-width" placeholder="123" required>
            </div>
          </div>
        </div>
        <div v-if="form.paymentMethod === 'paypal'" class="paypal-container">
          <paypal-buttons></paypal-buttons>
        </div>
        <button type="submit" class="submit-btn">Submit</button>
      </form>
    </div>
  </template>
  
  <script>
  export default {
    data() {
      return {
        form: {
          firstName: '',
          lastName: '',
          email: '',
          address: '',
          comments: '',
          paymentMethod: '',
          ccFirstName: '',
          ccLastName: '',
          ccNumber: '',
          ccExpiration: '',
          ccCVC: '',
        },
        successMessage: '',
      };
    },
    mounted() {
      this.loadPaypalScript();
    },
    methods: {
      async loadPaypalScript() {
        try {
          await loadScript({ "client-id": "YOUR_CLIENT_ID" });
          window.paypal.Buttons({
            createOrder: (data, actions) => {
              return actions.order.create({
                purchase_units: [{
                  amount: {
                    value: this.form.donationAmount,
                    currency_code: this.form.currency
                  }
                }]
              });
            },
            onApprove: (data, actions) => {
              return actions.order.capture().then(details => {
                this.successMessage = 'Transaction completed by ' + details.payer.name.given_name;
                this.submitForm();
              });
            }
          }).render('.paypal-container');
        } catch (error) {
          console.error("Failed to load PayPal script:", error);
        }
      },
      
    },
  };
  </script>
  
  <style>
  .container {
    max-width: 1300px;
  }
  
  .form-header h1 {
    font-size: 2rem;
    font-weight: bold;
    margin-bottom: 20px;
    text-align: center;
  }
  
  .product-details {
    width: 100%;
    border-collapse: collapse;
    margin-top: 15px;
  }
  
  .product-details th,
  .product-details td {
    padding: 10px 15px;
    border: 1px solid #ddd;
    text-align: left;
  }
  
  .product-details th {
    background-color: #f2f2f2;
    font-weight: bold;
  }
  
  .product-details td {
    text-align: right;
  }
  
  .product-details tbody tr:nth-child(even) {
    background-color: #f9f9f9;
  }
  
  .product-details tbody tr:nth-child(odd) {
    background-color: #fff;
  }
  
  .product-details tfoot {
    font-weight: bold;
    background-color: #f2f2f2;
  }
  
  .product-img {
    max-width: 50px; /* Adjust max-width as needed */
    max-height: 50px; /* Adjust max-height as needed */
  }
    .form-container {
      background: linear-gradient(135deg, #f5f7fa, #c3cfe2);
      color: #333;
      width: 60%;
      margin: auto;
      padding: 30px;
      border-radius: 20px;
      box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
      margin-top: 10%;
      margin-bottom: 5%;
      font-family: 'Montserrat', sans-serif;
      transition: transform 0.3s ease-in-out;
    }
    .form-container:hover {
      transform: translateY(-5px);
    }
    .form-payment {
      display: flex;
      flex-direction: column;
      gap: 25px;
    }
    .form-group {
      margin-bottom: 25px;
    }
    .form-group label {
      display: block;
      margin-top: 15px;
      margin-bottom: 10px;
      font-weight: bold;
      font-size: 1.1em;
    }
    .form-group input, 
    .form-group textarea, 
    .form-group select {
      width: 100%;
      padding: 12px;
      margin-top: 8px;
      border: 1px solid #ddd;
      border-radius: 10px;
      box-sizing: border-box;
      font-size: 1em;
      font-family: 'Montserrat', sans-serif;
      transition: border-color 0.3s ease-in-out;
    }
    .form-group input:focus, 
    .form-group textarea:focus, 
    .form-group select:focus {
      border-color: #5cb85c;
    }
    .name-container, 
    .amount-container,
     .expiration-container {
      display: flex;
      gap: 15px;
    }
    .form-group .half-width {
      width: 48%;
    }
    .form-group input[type="radio"] {
      width: auto;
      margin-right: 12px;
    }
    .form-group .donation-options, .form-group .payment-methods {
      display: flex;
      flex-direction: column;
      align-items: flex-start;
      gap: 12px;
    }
    .form-group .donation-option, .form-group .payment-option {
      display: flex;
      align-items: center;
      gap: 10px;
    }
    .submit-btn {
      background-color: #5cb85c;
      color: white;
      padding: 14px 30px;
      border: none;
      border-radius: 10px;
      cursor: pointer;
      font-size: 1.1em;
      font-weight: bold;
      transition: background-color 0.3s ease, transform 0.3s ease;
      font-family: 'Montserrat', sans-serif;
    }
    .submit-btn:hover {
      background-color: #4cae4c;
      transform: translateY(-3px);
    }
    .success-message {
      color: #5cb85c;
      margin-bottom: 20px;
      font-size: 1.1em;
      font-weight: bold;
    }
    .paypal-container {
      margin-top: 25px;
      text-align: center;
    }
  </style>
  
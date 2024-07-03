<template>
  <div class="form-container ">
    <form>
      <div>
        <h1>Payment By Debit or Credit Card *</h1>
        <div class="form-group">
          <label for="ccFirstName">Full Name *</label>
          <div class="name-container">
            <input type="text" class="half-width" placeholder="First Name" required>
            <input type="text" class="half-width" placeholder="Last Name" required>
          </div>
        </div>
        <div class="form-group">
          <label for="ccNumber">Credit Card Number *</label>
          <input type="text" id="ccNumber" placeholder="1234 5678 9012 3456" required>
        </div>
        <div class="form-group">
          <label for="ccExpiration">Card Expiration *</label>
          <div class="expiration-container">
            <input type="month" id="ccExpiration">
            <input type="text" id="ccCVC" class="half-width" placeholder="CVC" required>
          </div>
        </div>
      </div>
      <button type="submit" class="submit-btn">Submit</button>
    </form>
  </div>
</template>

<style>
  .form-container {
    background: #fff;
    color: #333;
    width: 60%;
    margin:auto;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    margin-top:100px;
    font-family: 'Roboto', sans-serif;
  }
  .form-group {
    margin-bottom: 20px;
  }
  .form-group label {
    display: block;
    font-weight: 400;
    font-size: 1em;
    color: #1a237e;
  }
  .form-group input, 
  .form-group textarea, 
  .form-group select {
    width: 100%;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 8px;
    box-sizing: border-box;
    font-size: 1em;
    transition: border-color 0.3s ease-in-out;
  }
  .name-container, 
  .expiration-container {
    display: flex;
    gap: 10px;
  }
  .submit-btn {
    background-color: #1976d2;
    color: white;
    padding: 10px 30px;
    border-radius: 8px;
    font-size: 15px;
  }
  h1{
    margin-bottom: 10px;
    text-align: center;
    color: #1a237e;
    font-size:20px;
    font-weight:bold;
  }
</style>

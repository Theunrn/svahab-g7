<template>
    <div class="container m-5">
      <div class="text">
        <h1>Shopping Cart</h1>
      </div>
      <table class="product-details mt-3">
        <thead>
          <tr>
            <th>Product</th>
            <th>Item Name</th>
            <th>Qty</th>
            <th>Unit</th>
            <th>Total</th>
            <th>Action</th> <!-- New column for delete action -->
          </tr>
        </thead>
        <tbody>
          <tr>
            <td class="product-cell">
              <img src="../../assets/ShopImage/card/ball.png" class="product-img" alt="Football ball" />
            </td>
            <td>ball</td>
            <td>1</td>
            <td>$3</td>
            <td>$3</td>
            <td>
              <button class="delete-btn" @click="deleteItem">
                <i class="fa fa-trash text-danger"></i> <!-- Delete icon -->
              </button>
            </td>
          </tr>
          <!-- Add more rows for other products if needed -->
        </tbody>
        <tfoot>
          <tr>
            <td colspan="4" class="text-right">Sub Total</td>
            <td>$3</td>
            <td></td> <!-- Empty cell to align with the action column -->
          </tr>
        </tfoot>
      </table>
  
      <!-- Checkout button -->
      <router-link to="/payment" class=" checkout text-center mt-4">
        <button class="checkout-btn mt-2" @click="checkout">Checkout</button>
      </router-link>
    </div>
  </template>
  
  <script>
  export default {
    methods: {
      deleteItem() {
        // Implement logic to delete the item from the cart
        console.log("Delete item clicked");
      },
      checkout() {
        // Implement logic for checkout process
        console.log("Checkout button clicked");
      }
    }
  };
  </script>
  
  <style scoped>
  .container {
    margin: 0 auto;
    padding: 70px;
    color: #000;
  }
  
  .text {
    text-align: start;
    margin-bottom: 20px;
    font-size: 24px;
    font-weight: bold;
  }
  
  .product-details {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
    box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
  }
  
  .product-details th,
  .product-details td {
    padding: 12px;
    text-align: center;
    border-bottom: 1px solid #ddd;
  }
  
  .product-details th {
    background-color: #edf1f8;
    font-weight: bold;
    color: #000;
  }
  
  .product-details .product-cell {
    width: 100px; /* Set a fixed width for the product cell */
  }
  
  .product-details .product-img {
    width: 60px; /* Adjusted smaller image size */
    height: auto;
    border-radius: 5px;
  }
  
  .product-details tbody tr:last-child td {
    border-bottom: none;
  }
  
  .product-details tfoot {
    background-color: #edf1f8;
    font-weight: bold;
  }
  
  .delete-btn {
    background: none;
    border: none;
    cursor: pointer;
    font-size: 20px;
  }
  .checkout{
    display: flex;
    justify-content: end;
  }
  
  .checkout-btn {
    padding: 10px 20px;
    background-color: #4CAF50;
    color: #fff;
    border: none;
    cursor: pointer;
    border-radius: 5px;
    font-size: 16px;
    transition: background-color 0.3s ease;
  }
  
  .checkout-btn:hover {
    background-color: #45a049;
  }
  </style>
  
  
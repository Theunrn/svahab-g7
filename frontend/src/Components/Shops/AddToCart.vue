<template>
  <div class="container m-auto" style="margin: auto; padding-top: 100px">
    <div class="text">
      <h1>Shopping Cart</h1>
    </div>
    <table class="product-details mt-3">
      <thead>
        <tr>
          <th>#</th>
          <th>Image</th>
          <th>User Name</th>
          <th>Product Name</th>
          <th>Product Color</th>
          <th>Product Size</th>
          <th>Quantity</th>
          <th>Price</th>
          <th>Total Amount</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="(item, index) in cartItems" :key="item.id">
          <td>{{ index + 1 }}</td>
          <td>
            <img
              :src="getImageUrl(item.product.image)"
              class="card-img-top"
              alt="Product Image"
              style="max-width: 80px"
            />
          </td>
          <td>{{ item.user.name }}</td>
          <td>{{ item.product.name }}</td>
          <td>{{ item.color.name }}</td>
          <td>{{ item.size.name }}</td>
          <td>
            <input
              type="number"
              v-model="item.quantity"
              @input="updateCartItem(item)"
              class="bg-white text-gray-700 rounded-md py-1 px-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent w-40"
            />
          </td>
          <td>${{ item.price }}</td>
          <td>${{ item.total_amount }}</td>
          <td>
            <button class="delete-btn ml-3" @click="deleteItem(item.id)">
              <i class="fa fa-trash text-danger"></i>
            </button>
          </td>
        </tr>
      </tbody>
    </table>

    <!-- Checkout button -->
    <router-link to="/payment" class="checkout text-center mt-4">
      <button class="checkout-btn mt-2" @click="createOrder()">Checkout</button>
    </router-link>
  </div>
</template>

<script>
import axios from 'axios'

export default {
  data() {
    return {
      cartItems: []
    }
  },

  computed: {
    totalAmount() {
      return this.cartItems
        .reduce((total, item) => total + item.quantity * item.price, 0)
        .toFixed(2)
    }
  },

  created() {
    this.fetchCartItems()
  },

  methods: {
    async fetchCartItems() {
      try {
        const response = await axios.get('http://127.0.0.1:8000/api/cart/list', {
          headers: {
            Authorization: `Bearer ${localStorage.getItem('access_token')}`
          }
        })
        if (response.data.success) {
          this.cartItems = response.data.data
          console.log(this.cartItems)
        } else {
          console.error('Failed to fetch cart items')
        }
      } catch (error) {
        console.error('Error fetching cart items:', error)
      }
    },

    async deleteItem(itemId) {
      try {
        await axios.delete(`http://127.0.0.1:8000/api/cart/delete/${itemId}`, {
          headers: {
            Authorization: `Bearer ${localStorage.getItem('access_token')}`
          }
        })
        this.cartItems = this.cartItems.filter((item) => item.id !== itemId)
      } catch (error) {
        console.error('Error deleting item:', error)
      }
    },

    async updateCartItem(item) {
      item.total_amount = (item.quantity * item.price).toFixed(2)
      try {
        const response = await axios.put(
          `http://127.0.0.1:8000/api/cart/update/${item.id}`,
          {
            quantity: item.quantity,
            total_amount: item.total_amount
          },
          {
            headers: {
              Authorization: `Bearer ${localStorage.getItem('access_token')}`
            }
          }
        )
        if (response.data.success) {
          console.log('Item updated successfully')
        } else {
          console.error('Failed to update item')
        }
      } catch (error) {
        console.error('Error updating item:', error)
      }
    },

    getImageUrl(imagePath) {
      return `http://127.0.0.1:8000/storage/${imagePath}` // Adjust URL if needed
    },

    async createOrder() {
      const orderProducts = this.cartItems.map((item) => ({
        product_id: item.product_id,
        color_id: item.color_id,
        size_id: item.size_id,
        qty: item.quantity
      }))

      try {
        const response = await axios.post(
          'http://127.0.0.1:8000/api/orders/create',
          {
            product_id: orderProducts.map((product) => product.product_id),
            qty: orderProducts.map((product) => product.qty),
            color_id: orderProducts.map((product) => product.color_id),
            size_id: orderProducts.map((product) => product.size_id)
          },
          {
            headers: {
              Authorization: `Bearer ${localStorage.getItem('access_token')}`
            }
          }
        )

        if (response.data.success) {
          console.log('Order created successfully')
          alert('Order placed successfully.')
        } else {
          throw new Error('Failed to create order')
        }
      } catch (error) {
        console.error('Error creating order:', error.response ? error.response.data : error)
        alert('Failed to create orders.')
      }
    }
  }
}
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
.checkout {
  display: flex;
  justify-content: end;
}

.checkout-btn {
  padding: 10px 20px;
  background-color: #4caf50;
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

.modal {
  display: flex;
  justify-content: center;
  align-items: center;
  position: fixed;
  z-index: 1;
  left: 0;
  top: 0;
  width: 100%;
  height: 100%;
  overflow: auto;
  background-color: rgb(0, 0, 0);
  background-color: rgba(0, 0, 0, 0.4);
}

.modal-content {
  background-color: #fefefe;
  margin: auto;
  padding: 20px;
  border: 1px solid #888;
  width: 80%;
  max-width: 500px;
}

.close {
  color: #aaa;
  float: right;
  font-size: 28px;
  font-weight: bold;
}

.close:hover,
.close:focus {
  color: black;
  text-decoration: none;
  cursor: pointer;
}

</style>
  
  
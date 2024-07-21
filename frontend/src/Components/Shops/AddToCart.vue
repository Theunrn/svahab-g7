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
          <th>Product Name</th>
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
              style="max-width: 50px"
            />
          </td>
          <td>{{ item.product.name }}</td>
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
            <div class="px-4 py-4 flex gap-3 whitespace-nowrap">
              <a class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-3 rounded-md inline-flex items-center" @click="confirmDeleteItem(item.id)">
                <i class="bx bx-trash text-2xl"></i>
              </a>
              <router-link :to="{path: '/product/detail/' + item.product.id, query:{customer:item.user_id}}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-3 rounded-md inline-flex items-center">
                <i class="bx bx-cart-add text-2xl"></i>
                <span class="ml-2">Checkout</span>
              </router-link>
            </div>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script>
import axios from 'axios'
import Swal from 'sweetalert2'

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

    async confirmDeleteItem(itemId) {
      Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
      }).then((result) => {
        if (result.isConfirmed) {
          this.deleteItem(itemId)
        }
      })
    },

    async deleteItem(itemId) {
      try {
        await axios.delete(`http://127.0.0.1:8000/api/cart/delete/${itemId}`, {
          headers: {
            Authorization: `Bearer ${localStorage.getItem('access_token')}`
          }
        })
        this.cartItems = this.cartItems.filter((item) => item.id !== itemId)
        Swal.fire(
          'Deleted!',
          'Your item has been deleted.',
          'success',
        )
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
  }
}
</script>

<style scoped>
.container {
  margin: 0 auto;
  padding: 20px;
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


</style>
  
  
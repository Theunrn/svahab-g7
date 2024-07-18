<template>
  <main>
    <div class="container px-5" style="margin-top: 30px">
      <router-link to="/" class="btn btn-primary btn-sm mb-3 text-center">
        <i class="bx bx-arrow-back"></i> Back
      </router-link>

      <div class="booking-list bg-white">
        <!-- Tabs for Primary, Bookings, and Orders -->
        <div class="tabs bg-dark flex text-center justify-between">
          <div class="title">
            <div class="tabs bg-dark">
              <div
                class="tab text-white text-center"
                :class="{ active: isActive('notification') }"
                @click="setActiveTab('notification')"
              >
                <i class="bx bx-archive-in text-xl me-2"></i> Primary
                <span class="badge" v-if="getNewCount(notifications) > 0">{{
                  getNewCount(notifications)
                }}</span>
              </div>
              <div
                class="tab text-white text-center me-2"
                :class="{ active: isActive('bookings') }"
                @click="setActiveTab('bookings')"
              >
                <i class="bx bx-calendar-check text-xl"></i> Bookings
                <span class="badge" v-if="getNewCount(bookingNotifications) > 0">{{
                  getNewCount(bookingNotifications)
                }}</span>
              </div>
              <div
                class="tab text-white text-center me-2"
                :class="{ active: isActive('orders') }"
                @click="setActiveTab('orders')"
              >
                <i class="bx bx-cart-add text-xl"></i> Orders
                <span class="badge" v-if="getNewCount(orderNotifications) > 0">{{
                  getNewCount(orderNotifications)
                }}</span>
              </div>
            </div>
          </div>
        </div>

        <!-- Notification List -->
        <div class="notification-list">
          <div
            class="notification-item"
            v-for="notification in filteredNotifications"
            :key="notification.id"
            :class="{ unread: !notification.read, read: notification.read }"
            @click="showNotificationDetails(notification)"
          >
            <div class="group">
              <div class="notification-header">
                <input
                  type="checkbox"
                  v-model="selectedNotifications"
                  :value="notification.id"
                  class="checkbox me-3"
                />
                <div :class="['notification-type', notification.notification_type.toLowerCase()]">
                  {{ notification.notification_type }}
                  <span v-if="!notification.read" class="badge bg-warning text-dark">New</span>
                </div>
              </div>
              <div class="notification-content mt-2">
                <h3 :class="{ bold: !notification.read }">{{ notification.notification_text }}</h3>
              </div>
            </div>
            <div class="notification-date">
              <i class="bx bx-time-five"></i>
              <span>{{ formatDate(notification.created_at) }}</span>
            </div>
          </div>
        </div>

        <!-- Popup Dialog for Notification Details -->
        <TransitionRoot as="template" :show="showPopup">
          <Dialog class="relative z-10" @close="showPopup = false">
            <TransitionChild
              as="template"
              enter="ease-out duration-300"
              enter-from="opacity-0"
              enter-to="opacity-100"
              leave="ease-in duration-200"
              leave-from="opacity-100"
              leave-to="opacity-0"
            >
              <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" />
            </TransitionChild>

            <div class="fixed inset-0 z-10 w-screen overflow-y-auto">
              <div class="flex min-h-full items-end justify-center p-4 sm:items-center sm:p-0">
                <TransitionChild
                  as="template"
                  enter="ease-out duration-300"
                  enter-from="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                  enter-to="opacity-100 translate-y-0 sm:scale-100"
                  leave="ease-in duration-200"
                  leave-from="opacity-100 translate-y-0 sm:scale-100"
                  leave-to="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                >
                  <DialogPanel
                    class="relative transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg"
                  >
                    <div class="flex justify-end p-4">
                      <button
                        type="button"
                        class="btn-close"
                        @click="showPopup = false"
                        aria-label="Close"
                      ></button>
                    </div>
                    <!-- Notification Details Content -->
                    <div class="bg-white px-4 pb-4 pt-5 sm:p-6 sm:pb-4">
                      <div class="sm:flex sm:items-start">
                        <div class="mt-3 text-center sm:ml-4 sm:mt-0 sm:text-left">
                          <DialogTitle as="h3" class="text-base font-semibold leading-6 text-gray-900">
                            Notification Details
                          </DialogTitle>
                          <div class="mt-2">
                            <p class="text-sm text-gray-500">Sent from your owner account!</p>
                            <p class="text-sm text-gray-500">
                              Dear customer! {{ selectedNotification.notification_text }}
                            </p>
                            <p class="text-sm text-gray-500">
                              Date time: {{ formatDate(selectedNotification.created_at) }}
                            </p>
                          </div>
                        </div>
                      </div>
                    </div>
                    <!-- Actions Section (Mark as Read and Delete Buttons) -->
                    <div class="bg-gray-50 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6">
                      <!-- See Details Button -->
                      <button
                        type="button"
                        class="ml-3 inline-flex w-full text-white justify-center rounded-md bg-primary px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 sm:w-auto"
                        @click="navigateToDetails(selectedNotification)"
                      >
                        See Details
                      </button>
                      <!-- Delete Button -->
                      <button
                        type="button"
                        class="ml-3 inline-flex w-full justify-center rounded-md bg-red-500 px-3 py-2 text-sm font-semibold text-white shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-red-600 sm:w-auto"
                        @click="deleteNotification(selectedNotification)"
                      >
                        Delete
                      </button>
                    </div>
                  </DialogPanel>
                </TransitionChild>
              </div>
            </div>
          </Dialog>
        </TransitionRoot>
      </div>
    </div>
  </main>
</template>
<script>
import axiosInstance from '@/plugins/axios'
import { useRoute, useRouter } from 'vue-router'
import { computed, ref, onMounted } from 'vue'
import { Dialog, DialogPanel, DialogTitle, TransitionChild, TransitionRoot } from '@headlessui/vue'
import { ExclamationTriangleIcon } from '@heroicons/vue/24/outline'

export default {
  setup() {
    const route = useRoute()
    const router = useRouter()
    const userId = computed(() => route.params.id)
    const notifications = ref([])
    const bookingNotifications = ref([])
    const orderNotifications = ref([])
    const selectedNotifications = ref([])
    const showPopup = ref(false)
    const selectedNotification = ref(null)
    const activeTab = ref('notification') // Initialize active tab
    const fieldId = ref('')
    const orderId = ref('')




    const fetchNotifications = async () => {
      try {
        const response = await axiosInstance.get(`/notifications/list/${userId.value}`)
        notifications.value = response.data.data
        // Filter notifications for bookings and orders
        bookingNotifications.value = notifications.value.filter((notification) =>
          notification.notification_type.toLowerCase().includes('booking')
        )
        orderNotifications.value = notifications.value.filter((notification) =>
          notification.notification_type.toLowerCase().includes('order')
        )
        // console.log(bookingNotifications.value)
      } catch (error) {
        console.error('Error fetching notifications:', error)
      }
    }

    const updateNotification = async (id) => {
      
      try {
        await axiosInstance.put(`/notification/update/${id}`)
        fetchNotifications() // Re-fetch notifications after updating
        console.log('Updated notification successfully')
      } catch (error) {
        console.error('Error updating notifications:', error)
      }
    }
    const deleteNotification = async (notification) => {
      try {
        await axiosInstance.delete(`/notifications/delete/${notification.id}`)
        fetchNotifications() // Re-fetch notifications after deleting
        console.log('Deleted notification successfully')
        showPopup.value = false // Close popup after deleting
      } catch (error) {
        console.error('Error deleting notification:', error)
      }
    }

    const getNewCount = (notificationList) => {
      return notificationList.filter((notification) => !notification.read).length
    }

    const showNotificationDetails = async (notification) => {
      showNotification(notification.id)
      
      try {
        await axiosInstance.put(`/notification/update/${notification.id}`)
        fetchNotifications() // Re-fetch notifications after marking as read
        selectedNotification.value = notification
        showPopup.value = true
      } catch (error) {
        console.error('Error marking notification as read:', error)
      }
    }

    const markNotificationAsRead = async (notification) => {
      notificationId.value = notification.id
      console.log(notification.id)
      try {
        await axiosInstance.put(`/notification/update/${notification.id}`)
        fetchNotifications() // Re-fetch notifications after marking as read
        console.log('Marked notification as read successfully')
        showPopup.value = false // Close popup after marking as read
      } catch (error) {
        console.error('Error marking notification as read:', error)
      }
    }
    const showNotification = async (id) => {
      try {
        const response = await axiosInstance.get(`/notification/show/${id}`)
  
          if (response.data.data.notification_type.toLowerCase().includes('booking')){
            showBooking(response.data.data.notification_data)
          }else if (response.data.data.notification_type.toLowerCase().includes('order')){
            showOrder(response.data.data.notification_data)
          }
        
      } catch (error) {
        console.error('Error marking notification as read:', error)
      }
    }
    const showBooking = async (id) => {
      try {
        const response = await axiosInstance.get(`/booking/show/${id}`)
        fieldId.value = response.data.data.field_id
        console.log(fieldId.value)
      } catch (error) {
        console.error('Error marking notification as read:', error)
      }
    }
    const showOrder = async (id) => {
      try {
        const response = await axiosInstance.get(`/order/show/${id}`)
        orderId.value = response.data.data.products[0].id;
      } catch (error) {
        console.error('Error marking notification as read:', error)
      }
    }

    const navigateToDetails = (notification) => {
      if (notification.notification_type.toLowerCase().includes('booking')) {
        router.push({
          path: `/field/detail/${fieldId.value}`,
          query: { customer: userId.value }
        })
      } else if (notification.notification_type.toLowerCase().includes('order')) {
        router.push({
          path: `/product/detail/${orderId.value}`,
          query: { customer: userId.value }
        })
      }
      showPopup.value = false // Close popup after navigating
    }

    // Format date function if needed
    const formatDate = (dateString) => {
      const options = {
        year: 'numeric',
        month: 'long',
        day: 'numeric',
        hour: 'numeric',
        minute: 'numeric',
        second: 'numeric',
        timeZone: 'UTC'
      }
      return new Date(dateString).toLocaleString('en-US', options)
    }

    // Fetch notifications and orders notifications on component mount
    onMounted(() => {
      fetchNotifications()
    })

    const isActive = (tabName) => {
      return activeTab.value === tabName
    }

    const setActiveTab = (tabName) => {
      activeTab.value = tabName
    }
    const filteredNotifications = computed(() => {
      if (activeTab.value === 'notification') {
        return notifications.value
      } else if (activeTab.value === 'bookings') {
        return bookingNotifications.value
      } else if (activeTab.value === 'orders') {
        return orderNotifications.value
      }
      return []
    })

    return {
      userId,
      notifications,
      bookingNotifications,
      orderNotifications,
      selectedNotifications,
      deleteNotification,
      isActive,
      activeTab,
      setActiveTab,
      updateNotification,
      getNewCount,
      showPopup,
      selectedNotification,
      showNotificationDetails,
      markNotificationAsRead,
      formatDate,
      filteredNotifications,
      navigateToDetails
    }
  },
  components: {
    Dialog,
    DialogPanel,
    DialogTitle,
    TransitionChild,
    TransitionRoot,
    ExclamationTriangleIcon
  }
}
</script>
<style scoped>
.booking-list {
  width: 100%;
  border-collapse: collapse;
}
.tabs {
  display: flex;
  background: #f1f3f4;
  padding: 10px;
  border-bottom: 1px solid #ddd;
}
.tab {
  margin-right: 30px;
  margin-left: 40px;
  cursor: pointer;
  text-decoration: none;
  color: black;
}
.tab.active {
  font-weight: bold;
  border-bottom: 2px solid #1a73e8;
}
.badge {
  background-color: green;
  color: white;
  padding: 2px 6px;
  border-radius: 12px;
  font-size: 12px;
}
.notification-list {
  background-color: #f5f5f5;
  padding: 20px;
  border-radius: 8px;
}
.notification-item {
  background-color: #fff;
  padding: 15px;
  margin-bottom: 15px;
  border-radius: 8px;
  display: flex;
  justify-content: space-between;
  align-items: flex-start;
  box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
  padding-left: 20px;
  gap: 10px;
}
.notification-item.unread {
  background-color: white; /* Background color for unread notifications */
}
.notification-item.read {
  background-color: #f0f0f0; /* Background color for read notifications */
}
.notification-header {
  display: flex;
  align-items: center;
}
.notification-type {
  font-size: 12px;
  padding: 2px 6px;
  border-radius: 4px;
  color: #fff;
  margin-right: 10px;
}
.notification-type.unread {
  background-color: black; /* Change background color for unread notifications */
}
.notification-type.read {
  background-color: #999; /* Change background color for read notifications */
}
.notification-content {
  flex: 1;
}
h3 {
  font-size: 16px;
  margin: 0 0 5px;
}
h3.bold {
  font-weight: bold; /* Font weight for unread notifications */
}
.notification-sender {
  color: #f00;
  font-size: 12px;
}
.notification-date {
  white-space: nowrap;
  color: #999;
  font-size: 12px;
  display: flex;
  align-items: center;
}
.notification-date span {
  margin-left: 5px;
}
.notification-type.booking_confirmed,
.notification-type.order_confirmed {
  background-color: green;
}
.notification-type.other_type {
  /* Add other types as necessary */
  background-color: orange;
}
.notification-type.booking_rejected {
  background-color: red; /* Fallback color */
}
.notification-type.booking_cancelled,
.notification-type.order_cancelled {
  background-color: red; /* Fallback color */
}
.notification-type.booking_rebooked {
  background-color: orange; /* Fallback color */
}
</style>

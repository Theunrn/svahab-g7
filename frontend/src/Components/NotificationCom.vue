<template>
  <main>
    <div class="container px-5" style="margin-top: 30px">
      <router-link to="/" class="btn btn-primary btn-sm mb-3 text-center">
        <i class="bx bx-arrow-back"></i> Back
      </router-link>
      <div class="booking-list bg-white">
        <!-- Delete button/icon -->

        <div class="tabs bg-dark flex text-center justify-between">
          <div class="title">
            <div class="tabs bg-dark">
              <router-link
                :to="{ path: '/notification/' + userId }"
                class="tab text-white text-center"
                :class="{ active: isActive('/notification') }"
                ><i class="bx bx-archive-in text-xl me-2"></i> Primary
                <span class="badge">{{ notifications.length }} new</span>
              </router-link>
              <router-link
                :to="{ path: '/bookings/' + userId }"
                class="tab text-white text-center me-2"
                :class="{ active: isActive('/bookings') }"
              >
                <i class="bx bx-calendar-check text-xl"></i> Bookings
                <span class="badge">{{ notifications.length }} new</span>
              </router-link>
              <router-link
                :to="{ path: '/orders/' + userId }"
                class="tab text-white text-center me-2"
                :class="{ active: isActive('/orders') }"
              >
                <i class="bx bx-cart-add text-xl"></i> Orders <span class="badge">0 new</span>
              </router-link>
            </div>
          </div>
          <div v-if="selectedNotifications.length > 0" class="text-end mt-3">
            <button class="btn btn-danger btn-sm" @click="deleteSelectedNotifications">
              <i class="bx bxs-trash text-xl"></i>
            </button>
          </div>
        </div>

        <div class="notification-list">
          <!-- Notifications for Primary/Bookings/Orders -->
          <template v-if="isActive('/notification') || isActive('/bookings')">
            <div
              class="notification-item"
              v-for="notification in notifications"
              :key="notification.id"
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
                  </div>
                </div>
                <div class="notification-content mt-2">
                  <h3>{{ notification.notification_text }}</h3>
                </div>
              </div>
              <div class="notification-date">
                <i class="bx bx-time-five"></i>
                <span>{{ notification.created_at }}</span>
              </div>
            </div>
          </template>
          <template v-if="isActive('/orders')">
            <div
              class="notification-item"
              v-for="notification in ordersNotifications"
              :key="notification.id"
            >
              <div class="group">
                <div class="notification-header">
                  <input
                    type="checkbox"
                    v-model="selectedNotifications"
                    :value="notification.id"
                    class="checkbox"
                  />
                  <div :class="['notification-type', notification.notification_type.toLowerCase()]">
                    {{ notification.notification_type }}
                  </div>
                </div>
                <div class="notification-content mt-2">
                  <h3>{{ notification.notification_text }}</h3>
                </div>
              </div>
              <div class="notification-date">
                <i class="bx bx-time-five"></i>
                <span>{{ notification.created_at }}</span>
              </div>
            </div>
          </template>
        </div>
      </div>
    </div>
  </main>
</template>

<script>
import axiosInstance from '@/plugins/axios';
import { useRoute } from 'vue-router';
import { computed, ref, onMounted } from 'vue';

export default {
  setup() {
    const route = useRoute();
    const userId = computed(() => route.params.id);
    const notifications = ref([]);
    const ordersNotifications = ref([]);
    const selectedNotifications = ref([]);

    const fetchNotifications = async () => {
      try {
        const response = await axiosInstance.get(`/notifications/list/${userId.value}`);
        notifications.value = response.data;
      } catch (error) {
        console.error('Error fetching notifications:', error);
      }
    };

    const fetchOrdersNotifications = async () => {
      try {
        const response = await axiosInstance.get(`/orders/list/${userId.value}`);
        ordersNotifications.value = response.data;
      } catch (error) {
        console.error('Error fetching orders notifications:', error);
      }
    };

    const deleteSelectedNotifications = async () => {
      try {
        const response = await axiosInstance.post('/notifications/delete', {
          notifications: selectedNotifications.value
        });

        // Handle success response if needed
        console.log(response.data);

        // After successful deletion, refresh notifications
        await fetchNotifications();
        await fetchOrdersNotifications();

        // Clear selected notifications
        selectedNotifications.value = [];
      } catch (error) {
        console.error('Error deleting notifications:', error);
        // Handle error if needed
      }
    };

    // Fetch notifications and orders notifications on component mount
    onMounted(() => {
      fetchNotifications();
      fetchOrdersNotifications();
    });

    const isActive = (tab) => {
      return route.path.includes(tab);
    };

    return {
      userId,
      notifications,
      ordersNotifications,
      selectedNotifications,
      isActive,
      deleteSelectedNotifications
    };
  }
};
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
.notification-content {
  flex: 1;
}
h3 {
  font-size: 16px;
  margin: 0 0 5px;
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
.notification-type.booking_confirmed {
  background-color: green;
}
.notification-type.other_type {
  /* Add other types as necessary */
  background-color: orange;
}
.notification-type.booking_rejected {
  background-color: red; /* Fallback color */
}
.notification-type.booking_cancelled {
  background-color: red; /* Fallback color */
}
.notification-type.booking_rebooked {
  background-color: orange; /* Fallback color */
}
</style>

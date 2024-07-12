<template>
  <div class="container mx-auto my-4 p-4 bg-white shadow-md rounded-lg">
    
    <h1 class="text-3xl font-bold text-center mb-6">Check your available time</h1>
    <FullCalendar :options="calendarOptions" />
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import FullCalendar from '@fullcalendar/vue3';
import timeGridPlugin from '@fullcalendar/timegrid';
import interactionPlugin from '@fullcalendar/interaction';
import axiosInstance from '@/plugins/axios';

const events = ref([]);
const handleDateClick = (info) => {
  const title = prompt('Enter Event Title:');
  if (title) {
    events.value.push({
      title,
      start: info.dateStr,
      allDay: info.allDay,
    });
    saveEvent(title, info.dateStr);
  }
};

import { computed } from 'vue';
const calendarOptions = computed(() => ({
  plugins: [timeGridPlugin, interactionPlugin],
  initialView: 'timeGridWeek',
  headerToolbar: {
    left: 'prev,next today',
    center: 'title',
    right: 'timeGridDay,timeGridWeek',
  },
  slotMinTime: '07:00:00',
  slotMaxTime: '23:00:00',
  dateClick: handleDateClick,
  editable: true,
  events: events.value, // Make sure events are correctly bound here
}));

onMounted(async () => {
  await fetchEvents();
});

const fetchEvents = async () => {
  try {
    const response = await axiosInstance.get('/event/list/2');
    events.value = response.data.data;
    
  } catch (error) {
    console.error('Error fetching events:', error);
  }
};

const saveEvent = async (title, date) => {
  try {
    const response = await axiosInstance.post('/event/store', {
      title,
      start: date,
    });
    console.log('Event saved:', response.data);
  } catch (error) {
    console.error('Error saving event:', error);
  }
};
</script>

<style scoped>
/* Add any additional styles if needed */
</style>

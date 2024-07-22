<template>
  <div class="container mx-auto my-4 p-4 bg-white shadow-md rounded-lg">
    <h1 class="text-3xl font-bold text-center mb-6">Class Schedule</h1>
    <FullCalendar :options="calendarOptions" />
  </div>
</template>

<script setup>
  // ======================= import nuccesary files and libraries =======================
  import { ref, onMounted, computed } from 'vue'
  import FullCalendar from '@fullcalendar/vue3'
  import timeGridPlugin from '@fullcalendar/timegrid'
  import interactionPlugin from '@fullcalendar/interaction'
  import axiosInstance from '@/plugins/axios'
  import { defineProps } from 'vue'

  // ======================= Define Props =======================
  const props = defineProps({
    fieldId: String
  })

  // ======================= Define Reactive Data =======================
  const events = ref([])

  // ======================= Define Computed Properties =======================
  const calendarOptions = computed(() => ({
    plugins: [timeGridPlugin, interactionPlugin],
    initialView: 'timeGridWeek',
    headerToolbar: {
      left: 'prev,next today',
      center: 'title',
      right: 'timeGridDay,timeGridWeek'
    },
    slotMinTime: '06:00:00',
    slotMaxTime: '23:00:00',
    events: events.value,
    editable: true,
    eventClick: handleEventClick,
    dateClick: handleDateClick
  }))

  // ======================= Lifecycle Hooks =======================
  onMounted(async () => {
    await fetchEvents()
  })

  // ======================= Fetch Events =======================
  const fetchEvents = async () => {
    try {
      const response = await axiosInstance.get(`/event/list/${props.fieldId}`)
      let fetchedEvents = response.data.data

      // Filter out events with booking_status 'cancelled' or 'rejected'
      fetchedEvents = fetchedEvents.filter(
        (event) => !['cancelled', 'rejected'].includes(event.booking_status)
      )

      // Assign random background colors to the remaining events
      fetchedEvents.forEach((event) => {
        event.backgroundColor = getRandomColor()
      })

      // Update the events.value with the filtered events
      events.value = fetchedEvents
    } catch (error) {
      console.error('Error fetching events:', error)
    }
  }

  // ======================= Handle Date Click =======================
  const handleDateClick = (info) => {
    const title = prompt('Enter Event Title:')
    if (title) {
      const newEvent = {
        title,
        start: info.dateStr,
        allDay: info.allDay,
        backgroundColor: getRandomColor()
      }
      events.value.push(newEvent)
      saveEvent(newEvent)
    }
  }

  // ======================= Handle Event Click =======================
  const handleEventClick = (info) => {
    // Format the start and end times without time zone details
    const formatDate = (date) => {
      return new Intl.DateTimeFormat('en-US', {
        dateStyle: 'medium',
        timeStyle: 'short'
      }).format(date)
    }

    alert(
      `Event: ${info.event.title}\nStart: ${formatDate(info.event.start)}\nEnd: ${formatDate(
        info.event.end
      )}`
    )
  }

  // ======================= Save Event =======================
  const saveEvent = async (event) => {
    try {
      const response = await axiosInstance.post('/event/store', {
        title: event.title,
        start: event.start
      })
      console.log('Event saved:', response.data)
    } catch (error) {
      console.error('Error saving event:', error)
    }
  }

  // ======================= Utility Functions =======================
  const getRandomColor = () => {
    const letters = '0123456789ABCDEF'
    let color = '#'
    for (let i = 0; i < 6; i++) {
      color += letters[Math.floor(Math.random() * 16)]
    }
    return color
  }

</script>

<style scoped>
  .container {
    max-width: 1200px;
  }

  .fc-toolbar {
    background-color: #f8f9fa;
    padding: 10px;
    border-radius: 5px 5px 0 0;
  }

  .fc-header-toolbar .fc-toolbar-title {
    font-size: 1.5rem;
    color: #007bff;
  }

  .fc-event {
    border: none;
    color: white;
    padding: 5px;
    border-radius: 3px;
    cursor: pointer;
  }

  .fc-event:hover {
    background-color: #0056b3;
  }

  .fc-timegrid-slot {
    background-color: #ffffff;
  }

  .fc-timegrid-slot:hover {
    background-color: #f1f1f1;
  }

  .fc-day-today {
    background-color: #df7819;
    border-radius: 5px;
  }

  .fc-timegrid .fc-scroller {
    overflow: visible !important;
  }

  .fc-timegrid-axis-cushion {
    color: #333;
  }

  .fc-timegrid-slot-label {
    color: #007bff;
  }

  .fc-timegrid-event {
    padding: 5px;
    border-radius: 4px;
    box-shadow: 0 1px 2px rgba(0, 0, 0, 0.1);
  }

  .fc-timegrid .fc-daygrid {
    border-right: none; /* Remove the border */
  }
</style>

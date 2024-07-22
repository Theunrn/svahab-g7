<template>
  
</template>

<script>
  // ======================= import nuccesary files and libraries =======================
  import { ref, onMounted, computed, watch } from 'vue'
  import axiosInstance from '@/plugins/axios'

  export default {
    name: 'FootballFields',

    // ======================= Props =======================
    props: {
      customer: Object,  // Customer object passed as a prop
      newFields: Array   // Array of new fields passed as a prop
    },

    setup() {
      // ======================= Reactive State =======================
      const fields = ref([])
      const searchQuery = ref('')

      // ======================= Fetch Data =======================
      const fetchFields = async () => {
        try {
          const response = await axiosInstance.get('/fields/list')
          fields.value = response.data.data
        } catch (error) {
          console.error('Error fetching fields:', error)
        }
      }

      // ======================= Computed Properties =======================
      const filteredFields = computed(() => {
        if (!searchQuery.value.trim()) {
          return fields.value  // Use all fields if search query is empty
        } else {
          const query = searchQuery.value.toLowerCase()
          return fields.value.filter((field) => field.name.toLowerCase().includes(query))
        }
      })

      // ======================= Watchers =======================
      watch(searchQuery, () => {
        filteredFields.value = filteredFields()  // Update filtered fields when search query changes
      })

      // ======================= Lifecycle Hooks =======================
      onMounted(() => {
        fetchFields()  // Fetch fields when the component is mounted
      })

      // ======================= Utility Functions =======================
      const getImageUrl = (imagePath) => {
        return imagePath ? `http://127.0.0.1:8000/storage/${imagePath}` : '/default-image.jpg'
      }

      // ======================= Return Values =======================
      return {
        fields,
        searchQuery,
        filteredFields,
        getImageUrl
      }
    }
  }

</script>

<style scoped>
  .card-me {
    justify-content: left;
    align-items: start;
    text-align: left;
    flex-wrap: wrap;
  }

  .card-wrapper {
    width: 23%;
    height: 40%;
    transition: transform 0.3s ease;
    position: relative;
  }

  .card-wrapper:hover {
    transform: scale(1.05);
  }

  .dollar {
    border-radius: 5px 5px 5px 0px;
  }

  .bg-overlay {
    background: linear-gradient(rgba(0, 0, 0, 0.3), rgba(0, 0, 0, 0.3)),
      url('../../assets/image/field.png');
    background-repeat: no-repeat;
    background-size: cover;
    background-position: center center;
    color: #fff;
    height: 200px;
    display: flex;
    align-items: center;
    justify-content: center;
    text-align: center;
    padding: 20px;
    border-radius: 6px 6px 0px 0px;
    position: relative;
  }

  .btn-group {
    position: absolute;
    bottom: 30px;
    width: 80%;
    display: flex;
    justify-content: center;
    opacity: 0;
    transition: opacity 0.3s ease, transform 0.3s ease;
    transform: translateY(20px);
  }

  /* Show buttons on hover */
  .card-wrapper:hover .btn-group {
    opacity: 1;
    transform: translateY(0);
  }

  @media (max-width: 768px) {
    .card-wrapper {
      width: 100%;
    }
  }
</style>

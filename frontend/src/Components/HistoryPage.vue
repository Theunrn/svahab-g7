<template>
  <div class="container flex text-black">
    <!-- Sidebar -->
    <aside class="w-64 fixed top-0 left-0 h-full bg-gray-900 text-white p-4">
      <h2 class="text-2xl font-semibold mb-4">History</h2>
      <nav>
        <ul>
          <li class="mb-4">
            <a href="#" class="flex items-center space-x-2 hover:text-gray-300">
              <i class="bx bx-history text-2xl"></i>
              <span>History</span>
            </a>
          </li>
        </ul>
      </nav>
    </aside>

    <!-- Main Content -->
    <main class="ml-64 p-4 flex-1">
      <div class="flex justify-between items-center mb-4">
        <input 
          type="text" 
          placeholder="Search history" 
          v-model="searchHistory" 
          class="p-2 rounded border w-1/2" 
        />
        <div>
          <button 
            @click="setFilter('data')" 
            :class="{'bg-gray-300': filter === 'data', 'bg-gray-200': filter !== 'data'}" 
            class="p-2 rounded mr-2 hover:bg-gray-300"
          >
            By date
          </button>
          <button 
            @click="setFilter('group')" 
            :class="{'bg-gray-300': filter === 'group', 'bg-gray-200': filter !== 'group'}" 
            class="p-2 rounded hover:bg-gray-300"
          >
            By group
          </button>
        </div>
      </div>
      <div class="History">
        <h3 class="text-lg font-semibold mb-2">Today - Saturday, June 29, 2024</h3>
        <hr>
        <ul v-if="filter === 'data'">
          <li 
            v-for="(entry, index) in filteredEntries" 
            :key="index" 
            class="flex items-center space-x-4 mb-2 p-2 hover:bg-gray-100 rounded-lg"
          >
            <input type="checkbox" />
            <p class="text-gray-500">{{ entry.time }}</p>
            <div class="flex-1">
              <p class="text-base font-medium">{{ entry.title }}</p>
            </div>
            <button class="text-gray-500 hover:text-gray-700">
              <i class="bx bx-dots-vertical-rounded"></i>
            </button>
          </li>
        </ul>
        <div v-else>
          <div v-for="(group, groupName) in groupedEntries" :key="groupName" class="mb-4 p-4 bg-white rounded-lg shadow">
            <h4 class="text-md font-semibold mb-2">{{ groupName }}</h4>
            <hr class="mb-2">
            <ul>
              <li 
                v-for="(entry, index) in group" 
                :key="index" 
                class="flex items-center space-x-4 mb-2 p-2 hover:bg-gray-100 rounded-lg"
              >
                <input type="checkbox" />
                <p class="text-gray-500">{{ entry.time }}</p>
                <div class="flex-1">
                  <p class="text-base font-medium">{{ entry.title }}</p>
                </div>
                <button class="text-gray-500 hover:text-gray-700">
                  <i class="bx bx-dots-vertical-rounded"></i>
                </button>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </main>
  </div>
</template>

<script setup>
import { ref, computed } from 'vue';

const historyEntries = ref([
  {
    time: '2:32 PM',
    title: 'Booking Field',
  },
  {
    time: '2:00 PM',
    title: 'Order Ball in the shop',
  },
  {
    time: '9:00 AM',
    title: 'Booking field name Hongda',
  },
]);

const filter = ref('data'); // reactive property to store the filter type
const searchHistory = ref(''); // reactive property to store the search query

// computed property to filter entries based on the filter type and search query
const filteredEntries = computed(() => {
  return historyEntries.value.filter(entry => {
    const matchesSearch = searchHistory.value === '' || entry.title.toLowerCase().includes(searchHistory.value.toLowerCase());
    return matchesSearch;
  });
});

// computed property to group entries by title keywords
const groupedEntries = computed(() => {
  const groups = {};
  filteredEntries.value.forEach(entry => {
    const keyword = entry.title.split(' ')[0]; // grouping by the first word of the title
    if (!groups[keyword]) {
      groups[keyword] = [];
    }
    groups[keyword].push(entry);
  });
  return groups;
});

// method to set the filter type
const setFilter = (type) => {
  filter.value = type;
};
</script>

<style scoped>
.container {
  display: flex;
  min-height: 100vh;
  flex-direction: column;
}
.main-content {
  background-color: #f9f9f9;
  padding: 1rem;
  border-radius: 0.5rem;
}
ul {
  list-style: none;
  padding: 0;
  margin: 0;
}
li {
  display: flex;
  align-items: center;
  justify-content: space-between;
  padding: 0.5rem;
  border-bottom: 1px solid #eaeaea;
}
li:last-child {
  border-bottom: none;
}
button {
  border: none;
  background: none;
  cursor: pointer;
}
button:hover {
  color: #007BFF;
}
.group-container {
  background-color: #ffffff;
  padding: 1rem;
  border-radius: 0.5rem;
  margin-bottom: 1rem;
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}
.group-container h4 {
  margin-bottom: 0.5rem;
}
</style>
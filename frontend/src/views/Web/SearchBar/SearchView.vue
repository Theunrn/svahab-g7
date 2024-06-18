<template>
    <div class="m-4">
      <div class="max-w-full rounded-lg shadow-md p-3 space-y-4 flex justify-center gap-5 bg-gray">
        <!-- Search Bar -->
        <input type="text" placeholder="Search..." class="w-full px-3 py-1 border border-gray-300 focus:outline-none" />
        <!-- Category Selector -->
        <select class="w-full px-3 py-2 border border-gray-300 focus:outline-none focus:border-blue-500">
          <option value="">Select Category</option>
          <option value="category1">Category 1</option>
          <option value="category2">Category 2</option>
          <option value="category3">Category 3</option>
        </select>
      </div>
    </div>
  </template>
  
<script>
export default {

}
</script>

<style>

</style>
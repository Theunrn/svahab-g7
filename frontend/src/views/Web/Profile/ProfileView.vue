<template>
  <div class="container mt-4">
    <div class="row">
      <!-- Profile Image -->
      <div class="col-md-2 mb-3"></div>
      <!-- Profile Details -->
      <div class="col-md-8">
        <div class="card">
          <div class="col-md-4 mb-3">
            <div class="card">
              <img :src="user.profilePicture" class="card-img-top" alt="Profile Picture" />
              <div class="card-body">
                <button class="btn btn-primary" @click="uploadProfilePicture">
                  Upload Profile Picture
                </button>
              </div>
            </div>
          </div>
          <div class="card-body">
            <h5 class="card-title">Profile Information</h5>
            <form @submit.prevent="saveProfile">
              <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" id="username" v-model="user.username" class="form-control" />
              </div>
              <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" id="email" v-model="user.email" class="form-control" />
              </div>
              <button type="submit" class="btn btn-primary me-3">Save</button>
              <a href="/" class="btn btn-dark">Back</a>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup lang="ts">
  import { ref } from 'vue'

  // Example user data (replace with your actual user data)
  const user = ref({
    username: 'JohnDoe',
    email: 'johndoe@example.com',
    profilePicture: '../assets/default-profile.jpg' // Placeholder for default profile picture
  })

  // Function to handle profile picture upload
  const uploadProfilePicture = () => {
    // Simulate file selection and upload process
    const fileInput = document.createElement('input')
    fileInput.type = 'file'
    fileInput.accept = 'image/*'
    fileInput.style.display = 'none'
    fileInput.addEventListener('change', (event) => {
      const file = (event.target as HTMLInputElement).files?.[0]
      if (file) {
        const reader = new FileReader()
        reader.onload = () => {
          user.value.profilePicture = reader.result as string
        }
        reader.readAsDataURL(file)
      }
    })
    document.body.appendChild(fileInput)
    fileInput.click()
    document.body.removeChild(fileInput)
  }

  // Function to save profile information (example)
  const saveProfile = () => {
    // Example: Simulate saving to backend
    console.log('Saving profile...', user.value)
    // In a real app, this would make an API call to update the user's profile
  }
</script>


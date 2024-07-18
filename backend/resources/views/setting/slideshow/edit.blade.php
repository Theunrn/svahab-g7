<x-app-layout>
    <!-- resources/views/admin/slideshows/edit.blade.php -->

    <div class="container mx-auto px-4 py-8">
        <h1 class="text-2xl font-bold mb-4">Edit Slide Show Image</h1>

        <form id="edit-slideShow-form" action="{{ route('admin.slideshow.update', $slideshow->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="image" class="block text-gray-700 font-bold mb-2">Image</label>
                <input type="file" id="image" name="image" class="border border-gray-300 p-2 w-full">
            </div>

            <div class="mb-4">
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                    Update Image
                </button>
            </div>
        </form>
    </div>
    <script>
        // Add event listener to the form
        document.getElementById('edit-slideShow-form').addEventListener('submit', function(event) {
          event.preventDefault(); // Prevent the form from submitting normally
    
          const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 1000,
            timerProgressBar: true,
            customClass: {
              icon: 'colored-toast',
              popup: 'colored-toast',
              title: 'colored-toast',
            },
            iconColor: '#a5dc86', // Green background for success
          });
    
          Toast.fire({
            icon: 'success',
            title: 'Slide show updated successfully!',
          }).then(() => {
            this.submit(); // Submit the form programmatically after the alert
          });
        });
      </script>
    
      <style>
        .colored-toast.swal2-icon-success {
          background-color: #58cf13 !important;
        }
    
        .colored-toast.swal2-icon-error {
          background-color: #f27474 !important;
        }
    
        .colored-toast.swal2-icon-warning {
          background-color: #f8bb86 !important;
        }
    
        .colored-toast.swal2-icon-info {
          background-color: #3fc3ee !important;
        }
    
        .colored-toast.swal2-icon-question {
          background-color: #87adbd !important;
        }
    
        .colored-toast .swal2-title {
          color: white;
        }
    
        .colored-toast .swal2-close {
          color: white;
        }
    
        .colored-toast .swal2-html-container {
          color: white;
        }
      </style>
</x-app-layout>
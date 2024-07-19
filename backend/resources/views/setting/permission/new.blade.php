<x-app-layout>
  <div>
    @if(session('success'))
      <script>
        const Toast = Swal.mixin({
          toast: true,
          position: 'top-end',
          showConfirmButton: false,
          timer: 1500,
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
          title: '{{ session("success") }}',
        });
      </script>
    @endif

    <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-200">
      <div class="container mx-auto px-6 py-1">
        <div class="bg-white shadow-md rounded my-6 p-5">
          <form id="create-product-form" method="POST" action="{{ route('admin.permissions.store') }}">
            @csrf
            @method('post')
            <div class="flex flex-col space-y-2">
              <label for="role_name" class="text-gray-700 select-none font-medium">Permission Name</label>
              <input id="role_name" type="text" name="name" value="{{ old('name') }}" placeholder="Enter permission"
                class="px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-200" />
            </div>
            <div class="text-center mt-16">
              <button type="submit"
                class="bg-blue-500 text-white font-bold px-5 py-1 rounded focus:outline-none shadow hover:bg-blue-600 transition-colors">Submit</button>
            </div>
          </form>
        </div>
      </div>
    </main>
  </div>

  <script>
    // Add event listener to the form
    document.getElementById('create-product-form').addEventListener('submit', function(event) {
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
        title: 'Permission created successfully!',
      }).then(() => {
        this.submit(); // Submit the form programmatically after the alert
      });
    });
  </script>

  <style>
    .colored-toast.swal2-icon-success {
      background-color: #a5dc86 !important;
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
    <div>
        <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-200">
            <div class="container mx-auto px-6 py-1">
              <div class="bg-white shadow-md rounded my-6 p-5">
                <form method="POST" action="{{ route('admin.permissions.store')}}">
                  @csrf
                  @method('post')
                <div class="flex flex-col space-y-2">
                  <label for="role_name" class="text-gray-700 select-none font-medium">Permission Name</label>
                  <input
                    id="role_name"
                    type="text"
                    name="name"
                    value="{{ old('name') }}"
                    placeholder="Enter permission"
                    class="px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-200"
                  />
                </div>
                <div class="text-center mt-16">
                  <button type="submit" class="bg-blue-500 text-white font-bold px-5 py-1 rounded focus:outline-none shadow hover:bg-blue-500 transition-colors ">Submit</button>
                </div>
              </div>
            </div>
        </main>
    </div>
</x-app-layout>

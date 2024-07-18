<x-app-layout>
  <div>
    <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-200">
      <div class="container mx-auto px-6 py-1 pb-16">
        <div class="bg-white shadow-md rounded my-6 p-5">
          <form id="edit-user-form" method="POST" action="{{ route('admin.users.update',$user->id)}}">
            @csrf
            @method('put')
            <!-- Image Preview -->
            <div class="mb-4">
              <label for="qr" class="block text-gray-700 text-sm font-bold mb-2">Current Image:</label>
              <img src="{{ asset('storage/' . $user->qr) }}" alt="{{ $user->qr }}" class="h-32 w-32 object-cover rounded">
            </div>

            <!-- Upload New Image -->
            <div class="mb-4">
              <label for="qr" class="block text-gray-700 text-sm font-bold mb-2">Update QR:</label>
              <input type="file" name="image" id="qr" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            </div>

        </div>
        <div class="flex flex-col space-y-2">
          <label for="name" class="text-gray-700 select-none font-medium">User Name</label>
          <input id="name" type="text" name="name" value="{{ old('name',$user->name) }}" placeholder="Enter name" class="px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-200" />
        </div>

        <div class="flex flex-col space-y-2">
          <label for="email" class="text-gray-700 select-none font-medium">Email</label>
          <input id="email" type="text" name="email" value="{{ old('email',$user->email) }}" placeholder="Enter email" class="px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-200" />
        </div>

        <div class="flex flex-col space-y-2">
          <label for="phone_number" class="text-gray-700 select-none font-medium">Phone Number</label>
          <input id="phone_number" type="text" name="phone_number" value="{{ old('phone_number',$user->phone_number) }}" placeholder="Enter Phone number" class="px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-200" />
        </div>

        <h3 class="text-xl my-4 text-gray-600">Role</h3>
        <div class="grid grid-cols-3 gap-4">
          @foreach($roles as $role)
          <div class="flex flex-col justify-cente">
            <div class="flex flex-col">
              <label class="inline-flex items-center mt-3">
                <input type="checkbox" class="form-checkbox h-5 w-5 text-blue-600" name="roles[]" value="{{$role->id}}" @if(count($user->roles->where('id',$role->id)))
                checked
                @endif
                ><span class="ml-2 text-gray-700">{{ $role->name }}</span>
              </label>
            </div>
          </div>
          @endforeach
        </div>
        <div class="text-center mt-16 mb-16">
          <button type="submit" class="bg-blue-500 text-white font-bold px-5 py-1 rounded focus:outline-none shadow hover:bg-blue-500 transition-colors ">Submit</button>
        </div>
      </div>
  </div>
  </main>
  </div>
  </div>
  <script>
    // Add event listener to the form
    document.getElementById('edit-user-form').addEventListener('submit', function(event) {
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
        title: 'User updated successfully!',
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
</x-app-layout>
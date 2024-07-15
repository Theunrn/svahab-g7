<x-app-layout>
  <!DOCTYPE html>
  <html lang="en">

  <head>
    <!-- Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
  </head>

  <body>
    <div>
      <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-200">
        <div class="container mx-auto px-6 py-8">
          <div class="flex justify-between items-center mb-4">
            <div class="text-right">
              @can('User create')
              <button id="toggleModal" class="bg-blue-500 text-white font-bold px-5 py-2 rounded focus:outline-none shadow hover:bg-blue-600 transition-colors duration-300">New User</button>
              @endcan
            </div>
          </div>
          <div class="bg-white shadow-md rounded my-6">
            <table class="min-w-full border-collapse">
              <thead class="bg-gray-200">
                <tr>
                  <th class="py-4 px-6 text-left border-b border-gray-300 font-bold text-sm text-gray-700">
                    Profile
                  </th>
                  <th class="py-4 px-6 text-left border-b border-gray-300 font-bold text-sm text-gray-700">
                    User Name
                  </th>
                  <th class="py-4 px-6 text-left border-b border-gray-300 font-bold text-sm text-gray-700">
                    Email
                  </th>
                  <th class="py-4 px-6 text-left border-b border-gray-300 font-bold text-sm text-gray-700">
                    Phone Number
                  </th>
                  <th class="py-4 px-6 text-left border-b border-gray-300 font-bold text-sm text-gray-700">
                    Role
                  </th>
                  <th class="py-4 px-6 text-left border-b border-gray-300 font-bold text-sm text-gray-700">
                    Auth
                  </th>
                  <th class="py-4 px-6 text-right border-b border-gray-300 font-bold text-sm text-gray-700">
                    Actions
                  </th>
                </tr>
              </thead>
              <tbody>
                @can('User access')
                @foreach($users as $user)
                @if(!$user->roles->pluck('name')->contains('admin') && $user->id !== auth()->user()->id)
                <tr>
                  <td class="py-2 px-6 border-b border-gray-300">
                    <div class="flex items-center">
                      <div class="h-10 w-10">
                        <img src="{{ $user->profile ? asset('images/' . $user->profile) : asset('images/default-profile.jpg') }}" alt="User Avatar" class="w-full h-full rounded-full object-cover">
                      </div>
                    </div>
                  </td>
                  <td class="py-4 px-6 border-b border-gray-300">{{ $user->name }}</td>
                  <td class="py-4 px-6 border-b border-gray-300">{{ $user->email }}</td>
                  <td class="py-4 px-6 border-b border-gray-300">{{ $user->phone_number }}</td>
                  <td class="py-4 px-6 border-b border-gray-300">
                    @foreach($user->roles as $role)
                    <span class="inline-block px-3 py-1 text-white text-xs font-semibold text-gray-700 mr-2 rounded-full
                            {{ $role->name === 'owner' ? 'bg-yellow-300' : '' }}
                            {{ $role->name === 'customer' ? 'bg-blue-300' : '' }}
                            {{ $role->name === 'admin' ? 'bg-red-300' : '' }}">
                      {{ $role->name }}
                    </span>
                    @endforeach
                  </td>
                  <td class="py-4 px-6 border-b border-gray-300">
                    @if(auth()->check() && $user->id === auth()->user()->id)
                    <span class="inline-block px-3 py-1 text-white text-xs font-semibold bg-green-400 rounded-full">Yes</span>
                    @else
                    <span class="inline-block px-3 py-1 text-white text-xs font-semibold bg-gray-400 rounded-full">No</span>
                    @endif
                  </td>
                  <td class="py-4 px-6 border-b border-gray-300 text-right">
                    @can('User edit')
                    @if(auth()->user()->roles->pluck('name')->contains('admin') ||
                    (auth()->user()->roles->pluck('name')->contains('owner') && $user->roles->pluck('name')->contains('customer')) ||
                    (auth()->user()->id === $user->id))
                    <a href="{{ route('admin.users.edit', $user->id) }}" class="text-blue-500 hover:text-blue-700 mr-2">
                      <i class='bx bx-edit text-2xl'></i>
                    </a>
                    @elseif(auth()->user()->roles->pluck('name')->contains('owner') && $user->roles->pluck('name')->contains('admin'))
                    <button class="text-blue-500 cursor-not-allowed" disabled>
                      <i class='bx bx-edit text-2xl mr-2'></i>
                    </button>
                    @endif
                    @endcan
                    @can('User delete')
                    @if(auth()->user()->roles->pluck('name')->contains('admin') ||
                    (auth()->user()->roles->pluck('name')->contains('owner') && $user->roles->pluck('name')->contains('customer')))
                    <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" class="inline">
                      @csrf
                      @method('DELETE')
                      <button type="submit" class="text-red-500 hover:text-red-700">
                        <i class='bx bx-trash text-2xl'></i>
                      </button>
                    </form>
                    @elseif(auth()->user()->roles->pluck('name')->contains('owner') && !$user->roles->pluck('name')->contains('customer'))
                    <button class="text-red-500 cursor-not-allowed" disabled>
                      <i class='bx bx-trash text-2xl'></i>
                    </button>
                    @endif
                    @endcan
                  </td>
                </tr>
                @endif
                @endforeach
                @endcan
              </tbody>
            </table>
          </div>
        </div>
      </main>
    </div>

    <!-- Main modal -->
    <div id="defaultModal" tabindex="-1" aria-hidden="true" class="hidden fixed inset-0 flex items-center justify-center bg-gray-800 bg-opacity-75 z-50">
      <div class="relative p-4 w-full max-w-2xl max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
          <!-- Modal header -->
          <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
            <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
              Create New User
            </h3>
            <button id="closeModal" type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white">
              <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
              </svg>
              <span class="sr-only">Close modal</span>
            </button>
          </div>
          <!-- Modal body -->
          <div class="p-4 md:p-5 space-y-4">
            <form action="{{ route('admin.users.store') }}" method="POST" enctype="multipart/form-data">
              @csrf
              <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="name">
                  Name
                </label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="name" type="text" placeholder="Name" name="name">
              </div>
              <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="email">
                  Email
                </label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="email" type="email" placeholder="Email" name="email">
              </div>
              <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="phone_number">
                  Phone Number
                </label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="phone_number" type="text" placeholder="Phone Number" name="phone_number">
              </div>
              <!-- Upload QR Code Image -->
              <div class="mb-4">
                <label for="qr" class="block text-gray-700 text-sm font-bold mb-2">QR Code Image:</label>
                <input type="file" name="qr" id="qr" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
              </div>
              <div class="flex flex-col space-y-2">
                <label for="password" class="text-gray-700 font-medium">Password</label>
                <input id="password" type="password" name="password" placeholder="Enter password" class="px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-200" />
              </div>
              <div class="flex flex-col space-y-2">
                <label for="password_confirmation" class="text-gray-700 font-medium">Confirm Password</label>
                <input id="password_confirmation" type="password" name="password_confirmation" placeholder="Re-enter password" class="px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-200" />
              </div>
              <h3 class="text-xl my-4 text-gray-600">Role</h3>
              <div class="grid grid-cols-3 gap-4">
                @foreach($roles as $role)
                <div class="flex flex-col justify-center">
                  <div class="flex flex-col">
                    <label class="inline-flex items-center mt-3">
                      <input type="checkbox" class="form-checkbox h-5 w-5 text-blue-600" name="roles[]" value="{{ $role->id }}"><span class="ml-2 text-gray-700">{{ $role->name }}</span>
                    </label>
                  </div>
                </div>
                @endforeach
              </div>
              <div class="flex items-center justify-between">
                <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
                  Create User
                </button>
              </div>
            </form>

          </div>
        </div>
      </div>
    </div>

    <script>
      // Get elements
      const toggleModalButton = document.getElementById('toggleModal');
      const modal = document.getElementById('defaultModal');
      const closeModalButton = document.getElementById('closeModal');

      // Function to toggle modal visibility
      const toggleModal = () => {
        modal.classList.toggle('hidden');
      };

      // Event listeners
      toggleModalButton.addEventListener('click', toggleModal);
      closeModalButton.addEventListener('click', toggleModal);
    </script>
  </body>

  </html>
</x-app-layout>
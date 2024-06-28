<x-app-layout>
  <div>
    <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-200">
      <div class="container mx-auto px-6 py-8">
        <div class="text-right mb-4">
          @can('User create')
          <a href="{{ route('admin.users.create') }}"
            class="bg-blue-500 text-white font-bold px-5 py-2 rounded focus:outline-none shadow hover:bg-blue-600 transition-colors duration-300">New
            User</a>
          @endcan
        </div>

        <div class="bg-white shadow-md rounded my-6">
          <table class="min-w-full border-collapse">
            <thead class="bg-gray-200">
              <tr>
                <th class="py-4 px-6 text-left border-b border-gray-300 font-bold text-sm text-gray-700">
                  Profile</th>
                <th class="py-4 px-6 text-left border-b border-gray-300 font-bold text-sm text-gray-700">
                  User Name</th>
                <th class="py-4 px-6 text-left border-b border-gray-300 font-bold text-sm text-gray-700">
                  Email</th>
                <th class="py-4 px-6 text-left border-b border-gray-300 font-bold text-sm text-gray-700">
                  Phone Number</th>
                <th class="py-4 px-6 text-left border-b border-gray-300 font-bold text-sm text-gray-700">
                  Role</th>
                <th class="py-4 px-6 text-right border-b border-gray-300 font-bold text-sm text-gray-700">
                  Actions</th>
              </tr>
            </thead>
            <tbody>
              @can('User access')
              
              @foreach($users as $user)
             
              <tr class="hover:bg-gray-100">
                <td class="py-2 px-6 border-b border-gray-300">
                  <div class="flex items-center">
                    <div class="h-10 w-10">
                      <img src="{{ $user->profile ? asset('images/' . $user->profile) : asset('images/default-profile.jpg') }}" alt="User Avatar" class="w-full h-full rounded-full object-cover">
                    </div>
                  </div>
                </td>
                <td class="py-4 px-6 border-b border-gray-300">{{ $user->name }}</td>
                <td class="py-4 px-6 border-b border-gray-300">{{ $user->email }}</td>
                <td class="py-4 px-6 border-b border-gray-300">{{$user->phone_number}}</td>
                <td class="py-4 px-6 border-b border-gray-300">
                  @foreach($user->roles as $role)
                  <span
                    class="inline-block px-3 py-1 text-white text-xs font-semibold text-gray-700 mr-2 rounded-full
                    {{ $role->name === 'owner' ? 'bg-yellow-300' : '' }}
                    {{ $role->name === 'customer' ? 'bg-blue-300' : '' }}
                    {{ $role->name === 'admin' ? 'bg-red-300' : '' }}">
                    {{ $role->name }}
                  </span>
                  @endforeach
                </td>
                <td class="py-4 px-6 border-b border-gray-300 text-right">
                  @can('User edit')
                  <a href="{{ route('admin.users.edit', $user->id) }}" class="text-blue-500 hover:text-blue-700 mr-2">
                    <i class='bx bx-edit text-2xl'></i> </a>
                  @endcan
                  @can('User delete')
                  <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" class="inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="text-red-500 hover:text-red-700">
                      <i class='bx bx-trash text-2xl'></i>
                    </button>
                  </form>
                  @endcan
                </td>
              </tr>
              @endforeach
              @endcan
            </tbody>
          </table>
        </div>
      </div>
    </main>
  </div>
</x-app-layout>
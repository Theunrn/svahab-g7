<x-app-layout>
  <div>
    <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-200">
      <div class="container mx-auto px-6 py-2">
        <div class="text-right m-3">
          @can('Permission create')
          <a id="openAddModal"
            class="bg-blue-500 text-white font-bold px-5 py-1 rounded focus:outline-none shadow hover:bg-blue-500 transition-colors">
            New Permission
          </a>
          @endcan
        </div>

        <div class="bg-white shadow-md rounded my-6">
          <table class="text-left w-full border-collapse">
            <thead>
              <tr>
                <th class="py-4 px-6 bg-grey-lightest font-bold text-sm text-grey-dark border-b border-grey-light">
                  Permission Name
                </th>
                <th class="py-4 px-6 bg-grey-lightest font-bold text-sm text-grey-dark border-b border-grey-light text-right">
                  Actions
                </th>
              </tr>
            </thead>
            <tbody>
              @can('Permission access')
              @foreach($permissions as $permission)
              <tr class="hover:bg-grey-lighter">
                <td class="py-4 px-6 border-b border-grey-light">{{ $permission->name }}</td>
                <td class="py-4 px-6 border-b border-grey-light text-right">
                  @can('Permission edit')
                  <a href="#" data-id="{{ $permission->id }}" data-name="{{ $permission->name }}"
                    class="text-grey-lighter font-bold py-1 px-3 rounded text-xs bg-green hover:bg-green-dark text-blue-400 openEditModal">
                    Edit
                  </a>
                  @endcan

                  @can('Permission delete')
                  <form action="{{ route('admin.permissions.destroy', $permission->id) }}" method="POST" class="inline">
                    @csrf
                    @method('delete')
                    <button
                      class="text-grey-lighter font-bold py-1 px-3 rounded text-xs bg-blue hover:bg-blue-dark text-red-400">
                      Delete
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

  <!-- Add Modal -->
  <div id="addModal" tabindex="-1" aria-hidden="true"
    class="hidden fixed inset-0 flex items-center justify-center bg-gray-800 bg-opacity-75 z-50">
    <main class="p-4 w-full max-w-xl max-h-full">
      <!-- Modal content -->
      <div class="bg-white rounded-lg shadow">
        <!-- Modal header -->
        <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
          <h3 class="text-xl font-semibold text-gray-900 dark:text-black">
            Add New Slide Show Permissions
          </h3>
          <button id="closeAddModal" type="button"
            class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white">
            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
              <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
            </svg>
            <span class="sr-only">Close modal</span>
          </button>
        </div>
        <!-- Modal body -->
        <div class="container mx-auto px-4 py-8">
          <form method="POST" action="{{ route('admin.permissions.store') }}">
            @csrf
            <div class="flex flex-col space-y-2">
              <label for="permission_name" class="text-gray-700 select-none font-medium">Permission Name</label>
              <input id="permission_name" type="text" name="name" value="{{ old('name') }}" placeholder="Enter permission"
                class="px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-200" />
            </div>
            <div class="flex items-center justify-between">
              <button type="submit"
                class="bg-blue-500 hover:bg-blue-700 text-white font-bold mt-2 py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                Submit
              </button>
            </div>
          </form>
        </div>
      </div>
    </main>
  </div>

  <!-- Edit Modal -->
  <div id="editModal" tabindex="-1" aria-hidden="true"
    class="hidden fixed inset-0 flex items-center justify-center bg-gray-800 bg-opacity-75 z-50">
    <main class="p-4 w-full max-w-xl max-h-full">
      <!-- Modal content -->
      <div class="bg-white rounded-lg shadow">
        <!-- Modal header -->
        <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
          <h3 class="text-xl font-semibold text-gray-900 dark:text-black">
            Edit Slide Show Permissions
          </h3>
          <button id="closeEditModal" type="button"
            class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white">
            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
              <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
            </svg>
            <span class="sr-only">Close modal</span>
          </button>
        </div>
        <!-- Modal body -->
        <div class="container mx-auto px-4 py-8">
          <form method="POST" id="editForm" action="">
            @csrf
            @method('put')
            <div class="flex flex-col space-y-2">
              <label for="edit_permission_name" class="text-gray-700 select-none font-medium">Permission Name</label>
              <input id="edit_permission_name" type="text" name="name" value="" placeholder="Enter permission"
                class="px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-200" />
            </div>
            <div class="flex items-center justify-between">
              <button type="submit"
                class="bg-blue-500 hover:bg-blue-700 text-white font-bold mt-2 py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                Submit
              </button>
            </div>
          </form>
        </div>
      </div>
    </main>
  </div>

  <script>
    document.getElementById('openAddModal').addEventListener('click', function () {
      document.getElementById('addModal').classList.remove('hidden');
    });

    document.getElementById('closeAddModal').addEventListener('click', function () {
      document.getElementById('addModal').classList.add('hidden');
    });

    document.querySelectorAll('.openEditModal').forEach(button => {
      button.addEventListener('click', function () {
        const id = this.getAttribute('data-id');
        const name = this.getAttribute('data-name');
        const editForm = document.getElementById('editForm');
        editForm.action = `/admin/permissions/${id}`;
        document.getElementById('edit_permission_name').value = name;
        document.getElementById('editModal').classList.remove('hidden');
      });
    });

    document.getElementById('closeEditModal').addEventListener('click', function () {
      document.getElementById('editModal').classList.add('hidden');
    });
  </script>
</x-app-layout>

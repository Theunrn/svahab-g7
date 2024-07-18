<x-app-layout>
  <div>
    <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-200">
      <div class="container mx-auto px-6 py-2">
        <div class="text-right">
          @can('Permission create')
            <a href="{{ route('admin.permissions.create') }}" class="bg-blue-500 text-white font-bold px-5 py-1 rounded focus:outline-none shadow hover:bg-blue-500 transition-colors">New Permission</a>
          @endcan
        </div>

        <div class="bg-white shadow-md rounded my-6">
          <table class="text-left w-full border-collapse">
            <thead>
              <tr>
                <th class="py-4 px-6 bg-grey-lightest font-bold text-sm text-grey-dark border-b border-grey-light">Permission Name</th>
                <th class="py-4 px-6 bg-grey-lightest font-bold text-sm text-grey-dark border-b border-grey-light text-right">Actions</th>
              </tr>
            </thead>
            <tbody>
              @can('Permission access')
                @foreach($permissions as $permission)
                  <tr class="hover:bg-grey-lighter">
                    <td class="py-4 px-6 border-b border-grey-light">{{ $permission->name }}</td>
                    <td class="py-4 px-6 border-b border-grey-light text-right">
                      @can('Permission edit')
                        <a href="{{ route('admin.permissions.edit', $permission->id) }}" class="text-grey-lighter font-bold py-1 px-3 rounded text-xs bg-green hover:bg-green-dark text-blue-400">Edit</a>
                      @endcan

                      @can('Permission delete')
                        <button onclick="deleteField('{{ $permission->id }}')" class="text-grey-lighter font-bold py-1 px-3 rounded text-xs bg-blue hover:bg-blue-dark text-red-400">Delete</button>
                        <form id="delete-field-{{ $permission->id }}" action="{{ route('admin.permissions.destroy', $permission->id) }}" method="POST" style="display: none;">
                          @csrf
                          @method('delete')
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

  <script>
    function deleteField(permissionId) {
      Swal.fire({
        title: '<span style="color: #d33; font-weight: bold;">Are you sure?</span>',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: '<span style="font-weight: bold;">Yes, delete it!</span>',
        cancelButtonText: '<span style="font-weight: bold;">Cancel</span>',
        background: '#f7f7f7',
        customClass: {
          popup: 'border-2 border-gray-300',
          confirmButton: 'bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded',
          cancelButton: 'bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded'
        }
      }).then((result) => {
        if (result.isConfirmed) {
          document.getElementById('delete-field-' + permissionId).submit();
        }
      });
    }
  </script>
</x-app-layout>

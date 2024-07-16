<x-app-layout>
    <div>
        <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-200">
            <div class="container mx-auto px-6 py-2">
                <div class="flex justify-between items-center mb-4">
                    <div>
                        <form action="{{ route('admin.categories.index') }}" method="GET" class="flex items-center" id="search-form">
                            <input type="text" name="search" placeholder="Search categories..." class="px-4 py-2 border rounded focus:outline-none focus:border-blue-500" id="search-input">
                        </form>
                    </div>
                    <div>
                        <a href="{{ route('admin.categories.create') }}" class="bg-blue-500 text-white font-bold px-5 py-1 rounded focus:outline-none shadow hover:bg-blue-700 transition-colors">New Category</a>
                    </div>
                </div>

                <div class="bg-white shadow-md rounded my-6">
                    <table class="text-left w-full border-collapse">
                        <thead>
                            <tr>
                                <th class="py-4 px-6 bg-grey-lightest font-bold text-sm text-grey-dark border-b border-grey-light">ID</th>
                                <th class="py-4 px-6 bg-grey-lightest font-bold text-sm text-grey-dark border-b border-grey-light">Category Name</th>
                                <th class="py-4 px-6 bg-grey-lightest font-bold text-sm text-grey-dark border-b border-grey-light text-right">Actions</th>
                            </tr>
                        </thead>
                        <tbody id="categories-table-body">
                            @foreach ($categories as $index => $category)
                            <tr class="hover:bg-grey-lighter">
                                <td class="py-4 px-6 border-b border-grey-light">{{ $index+1 }}</td>
                                <td class="py-4 px-6 border-b border-grey-light">{{ $category->name }}</td>
                                <td class="py-4 px-6 border-b border-grey-light text-right">
                                    <a href="{{ route('admin.categories.edit', $category->id) }}" class="text-grey-lighter font-bold py-1 px-3 rounded text-xs bg-green hover:bg-green-dark text-blue-400">Edit</a>

                                    <form action="{{ route('admin.categories.destroy', $category->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-grey-lighter font-bold py-1 px-3 rounded text-xs bg-blue hover:bg-blue-dark text-red-400">Delete</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </main>
    </div>

    <script>
        document.getElementById('search-input').addEventListener('input', function() {
            fetch(`{{ route('admin.categories.index') }}?search=${this.value}`, {
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    let tableBody = document.getElementById('categories-table-body');
                    tableBody.innerHTML = '';

                    data.categories.forEach(category => {
                        tableBody.innerHTML += `
                        <tr class="hover:bg-grey-lighter">
                            <td class="py-4 px-6 border-b border-grey-light">${category.id}</td>
                            <td class="py-4 px-6 border-b border-grey-light">${category.name}</td>
                            <td class="py-4 px-6 border-b border-grey-light text-right">
                                <a href="/admin/categories/${category.id}/edit" class="text-grey-lighter font-bold py-1 px-3 rounded text-xs bg-green hover:bg-green-dark text-blue-400">Edit</a>
                                <form action="/admin/categories/${category.id}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-grey-lighter font-bold py-1 px-3 rounded text-xs bg-blue hover:bg-blue-dark text-red-400">Delete</button>
                                </form>
                            </td>
                        </tr>
                    `;
                    });
                });
        });
    </script>
</x-app-layout>
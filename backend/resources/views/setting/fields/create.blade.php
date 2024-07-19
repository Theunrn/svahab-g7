<x-app-layout>
    <div class="container mt-4">
        <form action="{{ route('admin.fields.store') }}" method="POST" enctype="multipart/form-data"
            class="mt-4 bg-white p-6 rounded-lg shadow-lg max-w-2xl mx-auto">
            @csrf
            <div class="flex flex-col space-y-4">
                <div class="flex flex-col space-y-2">
                    <label for="image" class="text-gray-700 select-none font-medium">Image</label>
                    <input type="file" id="image" name="image"
                        class="px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-200">
                </div>

                <div class="flex flex-col space-y-2">
                    <label for="name" class="text-gray-700 select-none font-medium">Name</label>
                    <input type="text" id="name" name="name" value="{{ old('name') }}"
                        class="px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-200">
                </div>

                <div class="flex flex-col space-y-2">
                    <label for="location" class="text-gray-700 select-none font-medium">Location</label>
                    <input type="text" id="location" name="location" value="{{ old('location') }}"
                        class="px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-200">
                </div>

                <div class="flex flex-col space-y-2">
                    <label for="price" class="text-gray-700 select-none font-medium">Price</label>
                    <input type="text" id="price" name="price" value="{{ old('price') }}"
                        class="px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-200">
                </div>

                <div class="flex flex-col space-y-2">
                    <label for="field_type" class="text-gray-700 select-none font-medium">Field Type</label>
                    <input type="text" id="field_type" name="field_type" value="{{ old('field_type') }}"
                        class="px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-200">
                </div>

                <div class="flex flex-col space-y-2">
                    <label class="text-gray-700 select-none font-medium">Select province</label>
                    <select name="province" id="province"
                        class="px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-200">
                        <option value=""></option>
                    </select>
                </div>
                <button type="submit"
                        class="inline-block bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        Submit
                </button>
        </form>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const provinces = [
                'Banteay Meanchey',
                'Battambang',
                'Kampong Cham',
                'Kampong Chhnang',
                'Kampong Speu',
                'Kampong Thom',
                'Kampot',
                'Kandal',
                'Koh Kong',
                'Kratie',
                'Mondulkiri',
                'Phnom Penh',
                'Preah Vihear',
                'Prey Veng',
                'Pursat',
                'Ratanakiri',
                'Siem Reap',
                'Preah Sihanouk',
                'Stung Treng',
                'Svay Rieng',
                'Takeo',
                'Oddar Meanchey',
                'Kep',
                'Pailin',
                'Tbong Khmum'
            ];

            const provinceSelect = document.getElementById('province');
            
            provinces.forEach(province => {
                const option = document.createElement('option');
                option.value = province;
                option.textContent = province;
                provinceSelect.appendChild(option);
            });
        });
    </script>
</x-app-layout>

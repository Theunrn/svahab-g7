<header class="flex justify-between items-center py-4 px-6 bg-white border-b-4 border-indigo-600">
    <div class="flex items-center">
        <button @click="sidebarOpen = true" class="text-gray-500 focus:outline-none lg:hidden">
            <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M4 6H20M4 12H20M4 18H11" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                    stroke-linejoin="round"></path>
            </svg>
        </button>

        <div class="relative mx-4 lg:mx-0">
            <span class="absolute inset-y-0 left-0 pl-3 flex items-center">
                <svg class="h-5 w-5 text-gray-500" viewBox="0 0 24 24" fill="none">
                    <path
                        d="M21 21L15 15M17 10C17 13.866 13.866 17 10 17C6.13401 17 3 13.866 3 10C3 6.13401 6.13401 3 10 3C13.866 3 17 6.13401 17 10Z"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    </path>
                </svg>
            </span>

            <input class="form-input w-32 sm:w-64 rounded-md pl-10 pr-4 focus:border-indigo-600" type="text"
                placeholder="Search">
        </div>
    </div>

    <div class="flex items-center">
        <!-- Notifications-->
        <div class="relative mr-4" x-data="{ isOpen: false, filter: 'all' }" >
            <button @click="isOpen = !isOpen" class="mt-3">
                <svg class="h-6 w-6 text-gray-500" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M18 8A6 6 0 006 8c0 7-3 9-3 9h18s-3-2-3-9" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                    <path d="M13.73 21a2 2 0 01-3.46 0" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                    <path d="M13 21H11V19.5C11 19.2239 11.2239 19 11.5 19H13V21Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                </svg>
                <!-- Notification indicator -->
                <span class="absolute top-0 right-0 h-2.5 w-2.5 bg-red-500 rounded-full"></span>
            </button>
            <div x-show="isOpen" class="absolute right-0 mt-2 w-96 bg-white rounded-md overflow-hidden shadow-xl z-10">
                <div class="px-4 py-2 text-lg text-gray-700">
                    <p class="font-bold">Notifications</p>
                </div>
                <div class="px-4 py-2 text-lg text-gray-600 flex justify-around">
                    <p @click="filter = 'all'" :class="{'text-indigo-600': filter === 'all'}" class="font-bold cursor-pointer">All</p>
                    <p @click="filter = 'order'" :class="{'text-indigo-600': filter === 'order'}" class="font-bold cursor-pointer">Order</p>
                    <p @click="filter = 'booking'" :class="{'text-indigo-600': filter === 'booking'}" class="font-bold cursor-pointer">Booking</p>
                </div>
                <hr>
                <div class="px-4 py-2 text-sm text-gray-700" x-show="filter === 'all' || filter === 'booking'">
                    <ul class="list-disc list-inside">
                        <li><span class="font-bold">John Doe</span>: Booking #1234 - Confirmed (Hotel)</li>
                        <li><span class="font-bold">Jane Smith</span>: Booking #1235 - Pending (Flight)</li>
                    </ul>
                </div>
                <div class="px-4 py-2 text-sm text-gray-700" x-show="filter === 'all' || filter === 'order'">
                    <ul class="list-disc list-inside">
                        <li><span class="font-bold">John Doe</span>: Order #1234 - Confirmed (Hotel)</li>
                        <li><span class="font-bold">Jane Smith</span>: Order #1235 - Pending (Flight)</li>
                    </ul>
                </div>
            </div>

        </div>
        
        <!-- Dropdown for user profile -->
        <div x-data="{ dropdownOpen: false }" class="relative">
            <button @click="dropdownOpen = ! dropdownOpen"
                class="relative block h-8 w-8 rounded-full overflow-hidden shadow focus:outline-none">
                <img class="h-full w-full object-cover"
                    src="{{auth()->user()->profile  ? asset('images/' .  auth()->user()->profile ) : asset('images/default-profile.jpg') }}"
                    alt="Your avatar">
            </button>

            <div x-show="dropdownOpen" @click="dropdownOpen = false" class="fixed inset-0 h-full w-full z-10"
                style="display: none;"></div>

            <div x-show="dropdownOpen"
                class="absolute right-0 mt-2 w-48 bg-white rounded-md overflow-hidden shadow-xl z-10"
                style="display: none;">
                <a href="{{ route('admin.profile') }}"
                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-indigo-600 hover:text-white">Profile</a>

                <form method="POST" action="{{ route('admin.logout') }}">
                @csrf
                    <a href="{{ route('admin.logout') }}" onclick="event.preventDefault();
                                                this.closest('form').submit();"
                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-indigo-600 hover:text-white">Logout</a>
                </form>
            </div>
        </div>
    </div>
</header>
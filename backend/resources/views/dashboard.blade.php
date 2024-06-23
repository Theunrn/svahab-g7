<x-app-layout>
    <div>
        <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-200">
            <div class="container mx-auto px-6 py-8">
                <strong style="font-size: 30px">Dashboard</strong><br>
                <div class="inline-flex rounded-md shadow-sm">
                    <a href="#" aria-current="page"
                        class="px-4 py-2 text-sm font-medium text-blue-700 bg-white border border-gray-200 rounded-s-lg hover:bg-gray-100 focus:z-10 focus:ring-2 focus:ring-blue-700 focus:text-blue-700 dark:bg-gray-800 dark:border-gray-700 dark:text-white dark:hover:text-white dark:hover:bg-gray-700 dark:focus:ring-blue-500 dark:focus:text-white">
                        Yesterday
                    </a>
                    <a href="#"
                        class="px-4 py-2 text-sm font-medium text-gray-900 bg-white border-t border-b border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-2 focus:ring-blue-700 focus:text-blue-700 dark:bg-gray-800 dark:border-gray-700 dark:text-white dark:hover:text-white dark:hover:bg-gray-700 dark:focus:ring-blue-500 dark:focus:text-white">
                        Today
                    </a>
                    <a href="#"
                        class="px-4 py-2 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-e-lg hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-2 focus:ring-blue-700 focus:text-blue-700 dark:bg-gray-800 dark:border-gray-700 dark:text-white dark:hover:text-white dark:hover:bg-gray-700 dark:focus:ring-blue-500 dark:focus:text-white">
                        Tomorrow
                    </a>
                </div>

                <div class="group-card flex justify-center gap-2">
                    <div style="width: 24%"
                        class="bg-blue-200 flex gap-5 mt-8 p-6 border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700 transition duration-300 ease-in-out transform hover:-translate-y-1 hover:scale-105">
                        <i class='bx bx-calendar-check text-3xl dark:text-gray-400'></i>
                        <div class="content">
                            <strong style="font-size: 25px">200+</strong>
                            <p class="mb-3 font-normal text-black-500 dark:text-gray-400">Total Booking</p>
                        </div>
                    </div>
                    <div style="width: 24%"
                        class="flex gap-5 bg-green-200 mt-8 p-6 border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700 transition duration-300 ease-in-out transform hover:-translate-y-1 hover:scale-105">
                        <i class='bx bx-user text-3xl dark:text-gray-400'></i>
                        <div class="content">
                            <strong style="font-size: 25px">150+</strong>
                            <p class="mb-3 font-normal text-black-500 dark:text-gray-400">Total User</p>
                        </div>
                    </div>
                    <div style="width: 24%"
                        class="flex gap-5 mt-8 p-6 bg-yellow-200 border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700 transition duration-300 ease-in-out transform hover:-translate-y-1 hover:scale-105">
                        <i class='bx bx-clipboard  text-3xl dark:text-gray-400'></i>
                        <div class="content">
                            <strong style="font-size: 25px">100+</strong>
                            <p class="mb-3 font-normal text-black-500 dark:text-gray-400">Total Fields</p>
                        </div>
                    </div>
                    <div style="width: 24%"
                        class="flex gap-5 mt-8 p-6 bg-purple-300 border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700 transition duration-300 ease-in-out transform hover:-translate-y-1 hover:scale-105">
                        <i class='bx bx-money-withdraw text-3xl dark:text-gray-400'></i>
                        <div class="content">
                            <strong style="font-size: 25px">$300</strong>
                            <p class="mb-3 font-normal text-black-500 dark:text-gray-400">Revenue</p>
                        </div>
                    </div>
                    <div style="width: 24%"
                        class="flex gap-5 mt-8 p-6 bg-red-200 border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700 transition duration-300 ease-in-out transform hover:-translate-y-1 hover:scale-105">
                        <i class='bx bx-comment-detail text-3xl dark:text-gray-400'></i>
                        <div class="content">
                            <strong style="font-size: 25px">150+</strong>
                            <p class="mb-3 font-normal text-dark-500 dark:text-gray-400">Feedback</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="max-w-screen-lg mx-auto">
                <div class="bg-white shadow-md rounded-lg overflow-hidden w-full">
                    <div class="px-4 py-2">
                        <h2 class="text-3xl font-bold mb-2 border-b border-gray-200 pb-2 pt-2">Upcoming Bookings</h2>

                        <div class="bg-white shadow-md rounded-lg overflow-hidden w-full mb-2 px-3 py-2 transition duration-300 ease-in-out transform hover:-translate-y-1 hover:scale-105">
                            <div class="flex items-center justify-between mb-2">
                                <p class="text-lg font-semibold">Booking #12345</p>
                                <p class="text-gray-600">June 25, 2024</p>
                            </div>
                            <p class="text-gray-700">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                        </div>

                        <div class="bg-white shadow-md rounded-lg overflow-hidden w-full mb-2 px-3 py-2 transition duration-300 ease-in-out transform hover:-translate-y-1 hover:scale-105">
                            <div class="flex items-center justify-between mb-2">
                                <p class="text-lg font-semibold">Booking #67890</p>
                                <p class="text-gray-600">July 3, 2024</p>
                            </div>
                            <p class="text-gray-700">Pellentesque habitant morbi tristique senectus.</p>
                        </div>

                        <div class="bg-white shadow-md rounded-lg overflow-hidden w-full mb-2 px-3 py-2 transition duration-300 ease-in-out transform hover:-translate-y-1 hover:scale-105">
                            <div class="flex items-center justify-between mb-2">
                                <p class="text-lg font-semibold">Booking #67890</p>
                                <p class="text-gray-600">July 3, 2024</p>
                            </div>
                            <p class="text-gray-700">Pellentesque habitant morbi tristique senectus.</p>
                        </div>
                    </div>
                </div>
            </div>

        </main>
    </div>
</x-app-layout>
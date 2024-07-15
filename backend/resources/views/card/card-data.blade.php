<div class="container mx-auto px-6 py-5" x-data="{ selectedDay: 'today' }">
    <strong style="font-size: 30px">Dashboard</strong><br>
    <div class="inline-flex rounded-md shadow-sm">
        <a href="#" @click.prevent="selectedDay = 'today'" :class="selectedDay === 'today' ? 'text-blue-700 bg-gray-100' : 'text-gray-900 bg-white'" class="px-4 py-2 text-sm font-medium border-t border-b border-gray-200 hover:bg-gray-100 focus:z-10 focus:ring-2 focus:ring-blue-700 focus:text-blue-700">
            Today
        </a>
        <a href="#" @click.prevent="selectedDay = 'thisWeek'" :class="selectedDay === 'thisWeek' ? 'text-blue-700 bg-gray-100' : 'text-gray-900 bg-white'" class="px-4 py-2 text-sm font-medium border border-gray-200 rounded-r-lg hover:bg-gray-100 focus:z-10 focus:ring-2 focus:ring-blue-700 focus:text-blue-700">
            This Week
        </a>
        <a href="#" @click.prevent="selectedDay = 'thisMonth'" :class="selectedDay === 'thisMonth' ? 'text-blue-700 bg-gray-100' : 'text-gray-900 bg-white'" class="px-4 py-2 text-sm font-medium border border-gray-200 rounded-l-lg hover:bg-gray-100 focus:z-10 focus:ring-2 focus:ring-blue-700 focus:text-blue-700">
            This Month
        </a>
        <a href="#" @click.prevent="selectedDay = 'thisYear'" :class="selectedDay === 'thisYear' ? 'text-blue-700 bg-gray-100' : 'text-gray-900 bg-white'" class="px-4 py-2 text-sm font-medium border border-gray-200 rounded-l-lg hover:bg-gray-100 focus:z-10 focus:ring-2 focus:ring-blue-700 focus:text-blue-700">
            This Year
        </a>

    </div>

    <div class="group-card flex justify-center gap-2">

        <!--  data of today -->
        <template x-if="selectedDay === 'today'">
            <div class="w-full flex flex-wrap gap-2 mt-8">
                <div style="width: 19%;" class="flex gap-5 p-6 bg-yellow-100 border border-gray-200 rounded-lg shadow transition duration-300 ease-in-out transform hover:-translate-y-1 hover:scale-105 hover:bg-blue-900 hover:text-white">
                    <i class='bx bx-calendar-check text-3xl'></i>
                    <div class="content">
                        <strong style="font-size: 25px">{{ $totalBookings }}+</strong>
                        <p class="mb-3 font-normal text-black-500">Total Booking</p>
                    </div>
                </div>
                <div style="width: 19%;" class="flex gap-5 p-6 border border-gray-200 rounded-lg shadow transition duration-300 ease-in-out transform hover:-translate-y-1 hover:scale-105 hover:bg-blue-900 hover:text-white">
                    <i class='bx bx-user text-3xl'></i>
                    <div class="content">
                    <strong style="font-size: 25px">{{$totalUsers}}+</strong>
                        <p class="mb-3 font-normal text-black-500">Total User</p>
                    </div>
                </div>
                <div style="width: 19%;" class="flex gap-5 p-6 border bg-pink-200 border-gray-200 rounded-lg shadow transition duration-300 ease-in-out transform hover:-translate-y-1 hover:scale-105 hover:bg-blue-900 hover:text-white">
                    <i class='bx bx-clipboard text-3xl'></i>
                    <div class="content">
                        <strong style="font-size: 25px">{{$totalFiels}}+</strong>
                        <p class="mb-3 font-normal text-black-500">Total Fields</p>
                    </div>
                </div>
                <div style="width: 19%;" class="flex gap-5 p-6 border border-gray-200 rounded-lg shadow transition duration-300 ease-in-out transform hover:-translate-y-1 hover:scale-105 hover:bg-blue-900 hover:text-white">
                    <i class='bx bx-money-withdraw text-3xl'></i>
                    <div class="content">
                        <strong style="font-size: 25px">{{$totalPayments}} </strong>
                        <p class="mb-3 font-normal text-black-500">Revenue</p>
                    </div>
                </div>
                <div style="width: 19%;" class="flex gap-5 p-6 border bg-green-200 border-gray-200 rounded-lg shadow transition duration-300 ease-in-out transform hover:-translate-y-1 hover:scale-105 hover:bg-blue-900 hover:text-white">
                    <i class='bx bx-comment-detail text-3xl'></i>
                    <div class="content">
                        <strong style="font-size: 25px">{{$totalFeedbacks}} </strong>
                        <p class="mb-3 font-normal text-black-500">Feedback</p>
                    </div>
                </div>
            </div>
        </template>
        <!--  data of thisWeek -->
        <template x-if="selectedDay === 'thisWeek'">
            <div class="w-full flex flex-wrap gap-5 mt-8">
                <div style="width: 19%;" class="flex gap-5 p-6 bg-yellow-100 border border-gray-200 rounded-lg shadow transition duration-300 ease-in-out transform hover:-translate-y-1 hover:scale-105 hover:bg-blue-900 hover:text-white">
                    <i class='bx bx-calendar-check text-3xl'></i>
                    <div class="content">
                        <strong style="font-size: 25px">220+</strong>
                        <p class="mb-3 font-normal text-black-500">Total Booking</p>
                    </div>
                </div>
                <div style="width: 19%;" class="flex gap-5 p-6 border border-gray-200 rounded-lg shadow transition duration-300 ease-in-out transform hover:-translate-y-1 hover:scale-105 hover:bg-blue-900 hover:text-white">
                    <i class='bx bx-user text-3xl'></i>
                    <div class="content">
                        <strong style="font-size: 25px">200+</strong>
                        <p class="mb-3 font-normal text-black-500">Total User</p>
                    </div>
                </div>
            </div>
        </template>
        <!--  data of thisMonth -->
        <template x-if="selectedDay === 'thisMonth'">
            <div class="w-full flex flex-wrap gap-5 mt-8">
                <div style="width: 19%;" class="flex gap-5 p-6 bg-yellow-100 border border-gray-200 rounded-lg shadow transition duration-300 ease-in-out transform hover:-translate-y-1 hover:scale-105 hover:bg-blue-900 hover:text-white">
                    <i class='bx bx-calendar-check text-3xl'></i>
                    <div class="content">
                        <strong style="font-size: 25px">180+</strong>
                        <p class="mb-3 font-normal text-black-500">Total Booking</p>
                    </div>
                </div>
                <div style="width: 19%;" class="flex gap-5 p-6 border border-gray-200 rounded-lg shadow transition duration-300 ease-in-out transform hover:-translate-y-1 hover:scale-105 hover:bg-blue-900 hover:text-white">
                    <i class='bx bx-user text-3xl'></i>
                    <div class="content">
                        <strong style="font-size: 25px">250+</strong>
                        <p class="mb-3 font-normal text-black-500">Total User</p>
                    </div>
                </div>
            </div>
        </template>
        <!--  data of Years -->
        <template x-if="selectedDay === 'thisYear'">
            <div class="w-full flex flex-wrap gap-5 mt-8">
                <div style="width: 19%;" class="flex gap-5 p-6 bg-yellow-100 border border-gray-200 rounded-lg shadow transition duration-300 ease-in-out transform hover:-translate-y-1 hover:scale-105 hover:bg-blue-900 hover:text-white">
                    <i class='bx bx-calendar-check text-3xl'></i>
                    <div class="content">
                        <strong style="font-size: 25px">100+</strong>
                        <p class="mb-3 font-normal text-black-500">Total Booking </p>
                    </div>
                </div>
                <div style="width: 19%;" class="flex gap-5 p-6 border border-gray-200 rounded-lg shadow transition duration-300 ease-in-out transform hover:-translate-y-1 hover:scale-105 hover:bg-blue-900 hover:text-white">
                    <i class='bx bx-user text-3xl'></i>
                    <div class="content">
                        <strong style="font-size: 25px">500+</strong>
                        <p class="mb-3 font-normal text-black-500">Total User</p>
                    </div>
                </div>
            </div>
        </template>
    </div>
</div>
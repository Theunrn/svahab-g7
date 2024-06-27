<x-app-layout>
    <div class="container mx-auto px-6 py-5">
        <div class="max-w-md mx-auto bg-white rounded-xl shadow-lg overflow-hidden md:max-w-2xl">
            <div class="md:flex">
                <div class="md:flex-shrink-0">
                    <img class="h-48 w-full object-cover md:w-48" src="https://play-lh.googleusercontent.com/eJuvWSnbPwEWAQCYwl8i9nPJXRzTv94JSYGGrKIu0qeuG_5wgYtb982-2F_jOGtIytY" alt="Booking Image">
                </div>
                <div class="p-8">
                    <div class="uppercase tracking-wide text-2xl text-indigo-500 font-semibold mb-5">Booking Details</div>
                    <h2 class="block mt-1 text-lg leading-tight font-medium text-black">Field Name: {{ $booking->field->field_name }}</h2>
                    <div class="flex gap-1 mt-2">
                        <i class='bx bx-map text-2xl'></i>
                        <p class=" mt-1 text-gray-500">Location: {{ $booking->field->field_location }}</p>
                    </div>
                    <div class="mt-4">
                    
                        <div class="flex items-center mt-2">
                            <svg class="h-6 w-6 text-gray-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                            <span class="text-gray-600">Customer Name: {{ $booking->customer->name }}</span>
                        </div>
                        <div class="flex items-center mt-2">
                            <svg class="h-6 w-6 text-gray-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 19.207a7.752 7.752 0 001.415 1.415l2.828-2.829a4.978 4.978 0 01.707-.707L5.12 8.95a2 2 0 010-2.828l1.415-1.414a2 2 0 012.828 0l4.243 4.243a4.978 4.978 0 01.707.707l2.828-2.828a7.752 7.752 0 001.415 1.414l2.828-2.829A2 2 0 0121.121 5.12l-2.829 2.828a4.978 4.978 0 01-.707.707l4.243 4.243a2 2 0 010 2.828l-1.415 1.414a2 2 0 01-2.828 0l-4.243-4.243a4.978 4.978 0 01-.707-.707l-2.828 2.828z"></path></svg>
                            <span class="text-gray-600">Booking Date: {{ $booking->booking_date }}</span>
                        </div>
                        <div class="flex items-center mt-2">
                            <svg class="h-6 w-6 text-gray-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                            <span class="text-gray-600">Start Time: {{ $booking->start_time }}</span>
                        </div>
                        <div class="flex items-center mt-2">
                            <svg class="h-6 w-6 text-gray-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                            <span class="text-gray-600">End Time: {{ $booking->end_time }}</span>
                        </div>
                        <div class="flex items-center mt-2">
                            <svg class="h-6 w-6 text-gray-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                            <span class="text-gray-600">Status: 
                                <span class="inline-block px-3 py-1 text-xs font-semibold rounded-full
                                    {{ $booking->status === 'comfirmed' ? 'bg-green-100 text-green-800' : '' }}
                                    {{ $booking->status === 'rejected' ? 'bg-red-100 text-red-800' : '' }}
                                    {{ $booking->status === 'cancelled' ? 'bg-red-100 text-red-800' : '' }}
                                    {{ $booking->status === 'pending' ? 'bg-blue-100 text-blue-800' : '' }}">
                                    {{ $booking->status }}
                                </span>
                            </span>
                        </div>
                        <div class="flex items-center mt-2">
                            <svg class="h-6 w-6 text-gray-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                            <span class="text-gray-600">Payment Status: 
                                <span class="inline-block px-3 py-1 text-xs font-semibold rounded-full
                                    {{ $booking->payment_status === 'paid' ? 'bg-green-100 text-green-800' : '' }}
                                    {{ $booking->payment_status === 'unpaid' ? 'bg-red-100 text-red-800' : '' }}">
                                    {{ $booking->payment_status }}
                                </span>
                            </span>
                        </div>
                    </div>
                    <div class="mt-4">
                        <a href="{{ route('admin.bookings.index') }}"
                            class="bg-indigo-500 hover:bg-indigo-400 text-white font-bold py-1 px-4 border-b-4 border-indigo-700 hover:border-indigo-500 rounded">
                            Back to Bookings
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

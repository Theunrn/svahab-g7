<x-app-layout>
    <div class="container mx-auto px-6 py-5">
        <strong style="font-size: 30px">Booking Dashboard</strong><br>

        <div class="overflow-x-auto bg-white rounded-lg shadow overflow-y-auto relative mt-3">
            
            <table class="border-collapse table-auto w-full whitespace-no-wrap bg-white table-striped relative">
                <thead>
                    <tr class="text-left">
                        <th class="py-2 px-3 sticky top-0 bg-gray-200 border-b border-gray-300">
                            Booking ID
                        </th>
                        <th class="py-2 px-3 sticky top-0 bg-gray-200 border-b border-gray-300">
                            User ID
                        </th>
                        <th class="py-2 px-3 sticky top-0 bg-gray-200 border-b border-gray-300">
                            Field ID
                        </th>
                        <th class="py-2 px-3 sticky top-0 bg-gray-200 border-b border-gray-300">
                            Booking Date
                        </th>
                        <th class="py-2 px-3 sticky top-0 bg-gray-200 border-b border-gray-300">
                            Status
                        </th>
                        <th class="py-2 px-3 sticky top-0 bg-gray-200 border-b border-gray-300">
                            Payment Status
                        </th>
                        <th class="py-2 px-3 sticky top-0 bg-gray-200 border-b border-gray-300">
                            Actions
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($bookings as $booking)
                    <tr class="text-left">
                        <td class="py-2 px-3 border-b border-gray-300">{{ $booking->id }}</td>
                        <td class="py-2 px-3 border-b border-gray-300">{{ $booking->user_id }}</td>
                        <td class="py-2 px-3 border-b border-gray-300">{{ $booking->field_id }}</td>
                        <td class="py-2 px-3 border-b border-gray-300">{{ $booking->booking_date }}</td>
                        <td class="py-2 px-3 border-b border-gray-300">
                            <span class="inline-block px-3 py-1 text-black-500 text-xs font-semibold mr-2 rounded-full
                                {{ $booking->status === 'confirmed' ? 'bg-green-300 text-gray-700' : '' }}
                                {{ $booking->status === 'reject' ? 'bg-red-300 text-gray-700' : '' }}
                                {{  $booking->status === 'pending' ? 'bg-blue-400 text-white-300' : '' }}">
                                {{  $booking->status }}
                            </span>
                        </td>
                        <td class="py-2 px-3 border-b border-gray-300">
                            <span class="inline-block px-3 py-1 text-black text-xs font-semibold mr-2 rounded-full
                                {{ $booking->payment_status === 'paid' ? 'bg-green-300 text-gray-700' : '' }}
                                {{  $booking->payment_status === 'unpaid' ? 'bg-red-400 text-white-300' : '' }}">
                                {{  $booking->payment_status }}
                            </span>
                        </td>
                        <td class="py-2 px-3 border-b border-gray-300">
                            <a href="{{ route('admin.bookings.edit', $booking->id) }}"
                                class="text-blue-500 hover:text-blue-700 mr-2">
                                <i class='bx bx-edit text-2xl'></i>
                            </a>
                            <form action="{{ route('admin.bookings.destroy', $booking->id) }}" method="POST"
                                style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 hover:text-red-700">
                                    <i class='bx bx-trash text-2xl'></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

</x-app-layout>
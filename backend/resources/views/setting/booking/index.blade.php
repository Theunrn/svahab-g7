<x-app-layout>
    <div class="container mx-auto px-6 py-5">
        <strong class="text-2xl font-semibold mb-4">Booking Dashboard</strong>

        {{-- Filter by Status --}}
        <div class="flex justify-between items-center mb-4">
            <div class="flex items-center w-2/5">
                <select id="status_filter" name="status_filter" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    <option value="">All Bookings</option>
                    @foreach (['confirmed', 'cancelled', 'pending'] as $status)
                    <option value="{{ $status }}" {{ request('status')==$status ? 'selected' : '' }}>
                        {{ ucfirst($status) }}
                    </option>
                    @endforeach
                </select>
            </div>
            <div class="inline-flex rounded-md shadow-sm space-x-2 justify-end">
                <button id="filter-all" class="px-4 py-2 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-l-lg hover:bg-gray-100 focus:z-10 focus:ring-2 focus:ring-blue-700 focus:text-blue-700">
                    Show All
                </button>
                <button id="filter-last-month" class="px-4 py-2 text-sm font-medium text-gray-900 bg-white border border-gray-200 hover:bg-gray-100 focus:z-10 focus:ring-2 focus:ring-blue-700 focus:text-blue-700">
                    Last Month
                </button>
                <button id="filter-last-week" class="px-4 py-2 text-sm font-medium text-gray-900 bg-white border border-gray-200 hover:bg-gray-100 focus:z-10 focus:ring-2 focus:ring-blue-700 focus:text-blue-700">
                    Last Week
                </button>
                <button id="filter-today" class="px-4 py-2 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-r-lg hover:bg-gray-100 focus:z-10 focus:ring-2 focus:ring-blue-700 focus:text-blue-700">
                    Today
                </button>
            </div>
        </div>

        {{-- Table of Bookings --}}
        <div class="overflow-x-auto bg-white rounded-lg shadow overflow-y-auto relative mt-3">
            <table class="border-collapse table-auto w-full whitespace-no-wrap bg-white table-striped relative">
                <thead>
                    <tr class="text-left">
                        <th class="py-2 px-1 sticky top-0 bg-gray-200 border-b border-gray-300">#</th>
                        <th class="py-2 px-1 sticky top-0 bg-gray-200 border-b border-gray-300">Customer</th>
                        <th class="py-2 px-1 sticky top-0 bg-gray-200 border-b border-gray-300">Field Name</th>
                        <th class="py-2 px-1 sticky top-0 bg-gray-200 border-b border-gray-300">Start Time</th>
                        <th class="py-2 px-1 sticky top-0 bg-gray-200 border-b border-gray-300">End Time</th>
                        <th class="py-2 px-1 sticky top-0 bg-gray-200 border-b border-gray-300">Booking Date</th>
                        <th class="py-2 px-1 sticky top-0 bg-gray-200 border-b border-gray-300">Total Price</th>
                        <th class="py-2 px-1 sticky top-0 bg-gray-200 border-b border-gray-300">Status</th>
                        <th class="py-2 px-1 sticky top-0 bg-gray-200 border-b border-gray-300">Payment Status</th>
                        <th class="py-2 px-1 sticky top-0 bg-gray-200 border-b border-gray-300">Actions</th>
                    </tr>
                </thead>
                <tbody id="booking-list">
                    @php
                    $totalBookings = 0;
                    @endphp
                    @foreach ($bookings->where('status', '!=', 'cancelled') as $index =>$booking)
                    @if ($booking->status !== 'rejected')
                    @php
                    $totalBookings++;
                    @endphp
                    <tr class="text-left booking-row" data-status="{{ $booking->status }}">
                        <td class="py-2 px-1 border-b border-gray-300">{{ $index + 1 }}</td>
                        <td class="py-2 px-1 border-b border-gray-300">{{ $booking->customer->name }}</td>
                        <td class="py-2 px-1 border-b border-gray-300">{{ $booking->field->name }}</td>
                        <td class="py-2 px-1 border-b border-gray-300">{{ $booking->start_time }}</td>
                        <td class="py-2 px-1 border-b border-gray-300">{{ $booking->end_time }}</td>
                        <td class="py-2 px-1 border-b border-gray-300">{{ $booking->booking_date }}</td>
                        <td class="py-2 px-1 border-b border-gray-300">${{ $booking->total_price }}</td>
                        <td class="py-2 px-1 border-b border-gray-300">
                            <span class="inline-block px-2 py-1 text-white text-xs font-semibold rounded-full
                                    {{ $booking->status === 'confirmed' ? 'bg-green-500' : '' }}
                                    {{ $booking->status === 'rejected' ? 'bg-red-500' : '' }}
                                    {{ $booking->status === 'cancelled' ? 'bg-red-500' : '' }}
                                    {{ $booking->status === 'pending' ? 'bg-blue-500' : '' }}">
                                {{ $booking->status }}
                            </span>
                        </td>
                        <td class="py-2 px-3 border-b border-gray-300">
                            <span class="inline-block px-2 py-1 text-white text-xs font-semibold rounded-full
                                    {{ $booking->payment_status === 'paid' ? 'bg-green-500' : '' }}
                                    {{ $booking->payment_status === 'unpaid' ? 'bg-red-500' : '' }}">
                                {{ $booking->payment_status }}
                            </span>
                        </td>
                        <td class="py-3 px-3 border-b border-gray-300">
                            <a href="{{ route('admin.bookings.show', $booking->id) }}" class="bg-blue-500 text-xs hover:bg-blue-400 text-white font-bold py-1 px-3 border-blue-700 hover:border-blue-500 rounded">View</a>
                            @if ($booking->status == 'confirmed' || $booking->status == 'rejected')
                            <a href="{{ route('admin.bookings.cancel', $booking->id) }}" class="bg-red-500 hover:bg-red-400 mx-1 text-xs text-white font-bold py-1 px-3 border-red-700 hover:border-red-500 rounded">Cancel</a>
                            @else
                            <a href="{{ route('admin.bookings.accept', $booking->id) }}" class="bg-green-500 hover:bg-green-400 text-xs mx-1 text-white font-bold py-1 px-3 border-green-700 hover:border-green-500 rounded">
                                Accept
                            </a>
                            <a href="{{ route('admin.bookings.reject', $booking->id) }}" class="bg-red-500 hover:bg-red-400 text-xs mx-1 text-white font-bold py-1 px-3 border-red-700 hover:border-red-500 rounded">
                                Reject
                            </a>
                            @endif
                        </td>
                    </tr>
                    @endif
                    @endforeach
                </tbody>
                <tbody id="cancelled-booking-list">
                    @foreach ($bookings->where('status', 'cancelled') as $index => $booking)
                    @php
                    $totalBookings++;
                    @endphp
                    <tr class="text-left booking-row" data-status="{{ $booking->status }}">
                        <td class="py-2 px-1 border-b border-gray-300">{{ $index +1 }}</td>
                        <td class="py-2 px-1 border-b border-gray-300">{{ $booking->customer->name }}</td>
                        <td class="py-2 px-1 border-b border-gray-300">{{ $booking->field->name }}</td>
                        <td class="py-2 px-1 border-b border-gray-300">{{ $booking->start_time }}</td>
                        <td class="py-2 px-1 border-b border-gray-300">{{ $booking->end_time }}</td>
                        <td class="py-2 px-1 border-b border-gray-300">{{ $booking->booking_date }}</td>
                        <td class="py-2 px-1 border-b border-gray-300">${{ $booking->total_price }}</td>
                        <td class="py-2 px-1 border-b border-gray-300">
                            <span class="inline-block px-2 py-1 text-white text-xs font-semibold rounded-full
                                    {{ $booking->status === 'confirmed' ? 'bg-green-500' : '' }}
                                    {{ $booking->status === 'rejected' ? 'bg-red-500' : '' }}
                                    {{ $booking->status === 'cancelled' ? 'bg-red-500' : '' }}
                                    {{ $booking->status === 'pending' ? 'bg-blue-500' : '' }}">
                                {{ $booking->status }}
                            </span>
                        </td>
                        <td class="py-2 px-3 border-b border-gray-300">
                            <span class="inline-block px-2 py-1 text-white text-xs font-semibold rounded-full
                                    {{ $booking->payment_status === 'paid' ? 'bg-green-500' : '' }}
                                    {{ $booking->payment_status === 'unpaid' ? 'bg-red-500' : '' }}">
                                {{ $booking->payment_status }}
                            </span>
                        </td>
                        <td class="py-3 px-3 border-b border-gray-300">
                            <a href="{{ route('admin.bookings.show', $booking->id) }}" class="bg-blue-500 text-xs hover:bg-blue-400 text-white font-bold py-1 px-3 border-blue-700 hover:border-blue-500 rounded">View</a>
                            @if ($booking->status == 'confirmed' || $booking->status == 'rejected')
                            <a href="{{ route('admin.bookings.cancel', $booking->id) }}" class="bg-red-500 hover:bg-red-400 mx-1 text-xs text-white font-bold py-1 px-3 border-red-700 hover:border-red-500 rounded">Cancel</a>
                            @else
                            <a href="{{ route('admin.bookings.accept', $booking->id) }}" class="bg-green-500 hover:bg-green-400 text-xs mx-1 text-white font-bold py-1 px-3 border-green-700 hover:border-green-500 rounded">
                                Accept
                            </a>
                            <a href="{{ route('admin.bookings.reject', $booking->id) }}" class="bg-red-500 hover:bg-red-400 text-xs mx-1 text-white font-bold py-1 px-3 border-red-700 hover:border-red-500 rounded">
                                Reject
                            </a>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const statusFilter = document.getElementById('status_filter');
            const bookingList = document.getElementById('booking-list');
            const filterButtons = {
                all: document.getElementById('filter-all'),
                lastMonth: document.getElementById('filter-last-month'),
                lastWeek: document.getElementById('filter-last-week'),
                today: document.getElementById('filter-today')
            };

            let selectedDateRange = '';

            statusFilter.addEventListener('change', () => filterBookings());
            Object.keys(filterButtons).forEach(key => {
                filterButtons[key].addEventListener('click', () => {
                    selectedDateRange = key;
                    filterBookings();
                    setActiveButton(key);
                });
            });

            function setActiveButton(activeKey) {
                Object.keys(filterButtons).forEach(key => {
                    filterButtons[key].classList.toggle('bg-gray-100', key === activeKey);
                    filterButtons[key].classList.toggle('text-blue-700', key === activeKey);
                });
            }

            function filterBookings() {
                const status = statusFilter.value;

                Array.from(bookingList.querySelectorAll('tr')).forEach(row => {
                    const bookingDate = new Date(row.dataset.date);
                    const now = new Date();

                    let dateMatch = true;

                    if (selectedDateRange === 'lastMonth') {
                        const startOfMonth = new Date(now.getFullYear(), now.getMonth() - 1, 1);
                        const endOfMonth = new Date(now.getFullYear(), now.getMonth(), 0);
                        dateMatch = bookingDate >= startOfMonth && bookingDate <= endOfMonth;
                    } else if (selectedDateRange === 'lastWeek') {
                        const startOfWeek = new Date(now);
                        startOfWeek.setDate(startOfWeek.getDate() - (startOfWeek.getDay() + 7) % 7);
                        const endOfWeek = new Date(now);
                        endOfWeek.setDate(endOfWeek.getDate() - endOfWeek.getDay());
                        dateMatch = bookingDate >= startOfWeek && bookingDate <= endOfWeek;
                    } else if (selectedDateRange === 'today') {
                        const startOfDay = new Date(now.setHours(0, 0, 0, 0));
                        const endOfDay = new Date(now.setHours(23, 59, 59, 999));
                        dateMatch = bookingDate >= startOfDay && bookingDate <= endOfDay;
                    }

                    const statusMatch = status ? row.dataset.status === status : true;
                    row.style.display = dateMatch && statusMatch ? '' : 'none';
                });
            }

            // Initialize
            filterBookings();
        });
    </script>
</x-app-layout>
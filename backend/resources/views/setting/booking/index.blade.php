<x-app-layout>
    <div class="container mx-auto px-6 py-5">
        <strong class="text-2xl font-semibold mb-4">Booking Dashboard</strong>

        {{-- Filter by Status --}}
        <div class="flex justify-between items-center mb-4">
            <div class="flex items-center w-2/5">
                <select id="status_filter" name="status_filter"
                    class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    <option value="">All Bookings</option>
                    @foreach (['comfirmed', 'cancelled', 'pending'] as $status)
                    <option value="{{ $status }}" {{ request('status')==$status ? 'selected' : '' }}>
                        {{ ucfirst($status) }}
                    </option>
                    @endforeach
                </select>
            </div>
            <div class="inline-flex rounded-md shadow-sm space-x-2 justify-end">
                <a href="#" id="filter-last-month" 
                    class="px-4 py-2 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-l-lg hover:bg-gray-100 focus:z-10 focus:ring-2 focus:ring-blue-700 focus:text-blue-700">
                    Last Month
                </a>
                <a href="#" id="filter-last-week" 
                    class="px-4 py-2 text-sm font-medium text-gray-900 bg-white border border-gray-200 hover:bg-gray-100 focus:z-10 focus:ring-2 focus:ring-blue-700 focus:text-blue-700">
                    Last Week
                </a>
                <a href="#" id="filter-today"
                    class="px-4 py-2 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-r-lg hover:bg-gray-100 focus:z-10 focus:ring-2 focus:ring-blue-700 focus:text-blue-700">
                    Today
                </a>
            </div>
        </div>

        {{-- Table of Bookings --}}
        <div class="overflow-x-auto bg-white rounded-lg shadow overflow-y-auto relative mt-3">
            <table class="border-collapse table-auto w-full whitespace-no-wrap bg-white table-striped relative">
                <thead>
                    <tr class="text-left">
                        <th class="py-2 px-2 sticky top-0 bg-gray-200 border-b border-gray-300">ID</th>
                        <th class="py-2 px-2 sticky top-0 bg-gray-200 border-b border-gray-300">Customer</th>
                        <th class="py-2 px-2 sticky top-0 bg-gray-200 border-b border-gray-300">Field Name</th>
                        <th class="py-2 px-2 sticky top-0 bg-gray-200 border-b border-gray-300">Start Time</th>
                        <th class="py-2 px-2 sticky top-0 bg-gray-200 border-b border-gray-300">End Time</th>
                        <th class="py-2 px-2 sticky top-0 bg-gray-200 border-b border-gray-300">Booking Date</th>
                        <th class="py-2 px-2 sticky top-0 bg-gray-200 border-b border-gray-300">Status</th>
                        <th class="py-2 px-2 sticky top-0 bg-gray-200 border-b border-gray-300">Payment Status</th>
                        <th class="py-2 px-2 sticky top-0 bg-gray-200 border-b border-gray-300">Actions</th>
                    </tr>
                </thead>
                <tbody id="booking-list">
                    @foreach ($bookings->where('status', '!=', 'cancelled') as $booking)
                    @if ($booking->status !== 'rejected')
                    <tr class="text-left booking-row" data-status="{{ $booking->status }}">
                        <td class="py-2 px-3 border-b border-gray-300">{{ $booking->id }}</td>
                        <td class="py-2 px-3 border-b border-gray-300">{{ $booking->customer->name }}</td>
                        <td class="py-2 px-3 border-b border-gray-300">{{ $booking->field->name }}</td>
                        <td class="py-2 px-3 border-b border-gray-300">{{ $booking->start_time }}</td>
                        <td class="py-2 px-3 border-b border-gray-300">{{ $booking->end_time }}</td>
                        <td class="py-2 px-3 border-b border-gray-300">{{ $booking->booking_date }}</td>
                        <td class="py-2 px-3 border-b border-gray-300">
                            <span class="inline-block px-3 py-1 text-black text-xs font-semibold mr-2 rounded-full
                                    {{ $booking->status === 'comfirmed' ? 'bg-green-500 text-gray-700' : '' }}
                                    {{ $booking->status === 'rejected' ? 'bg-red-500 text-gray-700' : '' }}
                                    {{ $booking->status === 'cancelled' ? 'bg-red-500 text-gray-700' : '' }}
                                    {{ $booking->status === 'pending' ? 'bg-blue-500 text-white-300' : '' }}">
                                {{ $booking->status }}
                            </span>
                        </td>
                        <td class="py-2 px-3 border-b border-gray-300">
                            <span class="inline-block px-3 py-1 text-black text-xs font-semibold mr-2 rounded-full
                                    {{ $booking->payment_status === 'paid' ? 'bg-green-500 text-gray-700' : '' }}
                                    {{ $booking->payment_status === 'unpaid' ? 'bg-red-500 text-white-300' : '' }}">
                                {{ $booking->payment_status }}
                            </span>
                        </td>
                        <td class="py-3 px-3 border-b border-gray-300">
                            <a href="{{ route('admin.bookings.show', $booking->id) }}"
                                class="bg-blue-500 text-xs hover:bg-blue-400 text-white font-bold py-1 px-3 border-blue-700 hover:border-blue-500 rounded">View</a>
                            @if ($booking->status == 'comfirmed' || $booking->status == 'rejected')
                            <a href="{{ route('admin.bookings.cancel', $booking->id) }}"
                                class="bg-red-500 hover:bg-red-400 mx-1 text-xs text-white font-bold py-1 px-3 border-red-700 hover:border-red-500 rounded">Cancel</a>
                            @else
                            <a href="{{ route('admin.bookings.accept', $booking->id) }}"
                                class="bg-green-500 hover:bg-green-400 text-xs mx-1 text-white font-bold py-1 px-3 border-green-700 hover:border-green-500 rounded">
                                Accept
                            </a>
                            <a href="{{ route('admin.bookings.reject', $booking->id) }}"
                                class="bg-red-500 hover:bg-red-400 text-xs mx-1 text-white font-bold py-1 px-3 border-red-700 hover:border-red-500 rounded">
                                Reject
                            </a>
                            @endif
                        </td>
                    </tr>
                    @endif
                    @endforeach
                </tbody>
                <tbody id="cancelled-booking-list">
                    @foreach ($bookings->where('status', 'cancelled') as $booking)
                    <tr class="text-left booking-row" data-status="{{ $booking->status }}">
                        <td class="py-2 px-3 border-b border-gray-300">{{ $booking->id }}</td>
                        <td class="py-2 px-3 border-b border-gray-300">{{ $booking->customer->name }}</td>
                        <td class="py-2 px-3 border-b border-gray-300">{{ $booking->field->field_name }}</td>
                        <td class="py-2 px-3 border-b border-gray-300">{{ $booking->start_time }}</td>
                        <td class="py-2 px-3 border-b border-gray-300">{{ $booking->end_time }}</td>
                        <td class="py-2 px-3 border-b border-gray-300">{{ $booking->booking_date }}</td>
                        <td class="py-2 px-3 border-b border-gray-300">
                            <span class="inline-block px-3 py-1 text-white text-xs font-semibold mr-2 rounded-full
                                    {{ $booking->status === 'comfirmed' ? 'bg-green-500 text-gray-700' : '' }}
                                    {{ $booking->status === 'rejected' ? 'bg-red-500 text-gray-700' : '' }}
                                    {{ $booking->status === 'cancelled' ? 'bg-red-500 text-gray-700' : '' }}
                                    {{ $booking->status === 'pending' ? 'bg-blue-500 text-white-300' : '' }}">
                                {{ $booking->status }}
                            </span>
                        </td>
                        <td class="py-2 px-3 border-b border-gray-300">
                            <span class="inline-block px-3 py-1 text-white text-xs font-semibold mr-2 rounded-full
                                    {{ $booking->payment_status === 'paid' ? 'bg-green-500 text-gray-700' : '' }}
                                    {{ $booking->payment_status === 'unpaid' ? 'bg-red-500 text-white-300' : '' }}">
                                {{ $booking->payment_status }}
                            </span>
                        </td>
                        <td class="py-3 px-3 border-b border-gray-300">
                            <a href="{{ route('admin.bookings.cancel', $booking->id) }}"
                                class="bg-blue-500 text-xs hover:bg-blue-400 text-white font-bold py-1 px-3 border-blue-700 hover:border-blue-500 rounded">View</a>
                            <a href="{{ route('admin.bookings.rebook', $booking->id) }}"
                                class="bg-yellow-500 text-xs hover:bg-yellow-400 text-white font-bold py-1 px-3 rounded ml-1">Rebook</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        {{-- View All Button --}}
        <div class="text-center mt-4">
            @if(count($bookings) > 5)
             <button id="view-more"
                class="hover:border-b border-blue-700 text-blue-600 font-bold">
                View All
                </button>
            @endif
        </div>

    </div>

    {{-- JavaScript for Pagination and Filtering --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const rows = document.querySelectorAll('.booking-row');
            const viewMoreBtn = document.getElementById('view-more');
            const rowsPerPage = 5;
            let showingAll = false;
            
            // Function to update visible rows
            function updateRows() {
                rows.forEach((row, index) => {
                    row.style.display = (showingAll || index < rowsPerPage) ? '' : 'none';
                });
            }
            
            // Event listener for view more/less button
            viewMoreBtn.addEventListener('click', () => {
                showingAll = !showingAll;
                viewMoreBtn.textContent = showingAll ? 'View Less' : 'View All';
                updateRows();
            });
            
            // Initially update rows based on current state
            updateRows();
        });

        // Filtering by status
        document.addEventListener('DOMContentLoaded', function() {
            const statusFilter = document.getElementById('status_filter');

            // Add event listener for change event
            statusFilter.addEventListener('change', function() {
                const selectedStatus = statusFilter.value;
                // Get all elements with class 'booking-row' (assuming this class is used for filtered rows)
                const bookingRows = document.querySelectorAll('.booking-row');
                bookingRows.forEach(function(row) {
                    const rowStatus = row.getAttribute('data-status');
                    // Show all rows if no filter is selected or if the row matches the selected status
                    if (selectedStatus === '' || rowStatus === selectedStatus) {
                        row.style.display = '';
                    } else {
                        row.style.display = 'none';
                    }
                });
            });
        });

        // Filter by booking date for today
        document.addEventListener('DOMContentLoaded', function () {
            const filterToday = document.getElementById('filter-today');
            const filterLastWeek = document.getElementById('filter-last-week');
            const filterLastMonth = document.getElementById('filter-last-month');

            const filterByDateRange = (startDate, endDate) => {
                const bookingRows = document.querySelectorAll('.booking-row');
                bookingRows.forEach(function (row) {
                    const bookingDate = row.querySelector('td:nth-child(6)').textContent.trim();
                    if (bookingDate >= startDate && bookingDate <= endDate) {
                        row.style.display = '';
                    } else {
                        row.style.display = 'none';
                    }
                });
            };

            filterToday.addEventListener('click', function () {
                const today = new Date().toISOString().split('T')[0];
                filterByDateRange(today, today);
            });

            filterLastWeek.addEventListener('click', function () {
                const today = new Date().toISOString().split('T')[0];
                const lastWeekStart = new Date(new Date().setDate(new Date().getDate() - 7)).toISOString().split('T')[0];
                filterByDateRange(lastWeekStart, today);
            });

            filterLastMonth.addEventListener('click', function () {
                const today = new Date().toISOString().split('T')[0];
                const lastMonthStart = new Date(new Date().setMonth(new Date().getMonth() - 1)).toISOString().split('T')[0];
                const lastMonthEnd = new Date(new Date().setDate(new Date().getDate() - 7)).toISOString().split('T')[0];
                filterBookingsByDate(lastMonthStart, lastMonthEnd);
            });
            function filterBookingsByDate(startDate, endDate) {
                const bookingRows = document.querySelectorAll('.booking-row');
                bookingRows.forEach(function(row) {
                    const bookingDate = row.querySelector('td:nth-child(6)').textContent.trim();
                    if (bookingDate >= startDate && bookingDate <= endDate) {
                        row.style.display = '';
                    } else {
                        row.style.display = 'none';
                    }
                });
            }
        });
    </script>
</x-app-layout>

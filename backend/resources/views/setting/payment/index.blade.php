<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      Payment
    </h2>
  </x-slot>
  <div class="container mt-5">
    <div class="flex flex-col space-y-4">
      <!-- Booking Payment Section -->
      <div class="overflow-x-auto flex-grow">
        <div class="overflow-x-auto flex-1">
          <div class="flex">
            <h1 class="m-5 text-2xl font-bold" style="margin-right: auto;">Booking Payment</h1>
            <div style="width: 19%;" class="card flex justify-center gap-5 mb-3 p-4 bg-yellow-100 border border-gray-100 rounded-lg shadow">
              <div class="content">
                <p class="font-bold font-normal text-black-500">Total Booking</p>
                <strong style="font-size: 25px">200+</strong>
              </div>
            </div>
          </div>
          <table class="min-w-full w-full bg-white shadow-md border border-gray-200">
            <thead class="bg-gray-800 text-white">
              <tr>
                <th scope="col" class="px-4 py-3 text-left text-xs font-medium uppercase tracking-wider">ID</th>
                <th scope="col" class="px-4 py-3 text-left text-xs font-medium uppercase tracking-wider">Customer Name</th>
                <th scope="col" class="px-4 py-3 text-left text-xs font-medium uppercase tracking-wider">Customer Email</th>
                <th scope="col" class="px-4 py-3 text-left text-xs font-medium uppercase tracking-wider">Amount</th>
                <th scope="col" class="px-4 py-3 text-left text-xs font-medium uppercase tracking-wider">Method</th>
                <th scope="col" class="px-4 py-3 text-left text-xs font-medium uppercase tracking-wider">Currency</th>
                <th scope="col" class="px-4 py-3 text-left text-xs font-medium uppercase tracking-wider">Code</th>
                <th scope="col" class="px-4 py-3 text-left text-xs font-medium uppercase tracking-wider">Payment Date</th>
              </tr>
            </thead>
            <tbody id="booking-rows" class="divide-y divide-gray-200">
              <!-- Initial Booking rows will be inserted here -->
            </tbody>
          </table>
          <button id="show-more-booking" class="mt-3 px-4 py-2 bg-blue-500 text-white rounded">Show More</button>
        </div>
      </div>

      <hr class="m-5">

      <!-- Order Payment Section -->
      <div class="overflow-x-auto flex-grow">
        <div class="overflow-x-auto flex-1">
          <div class="flex">
            <h1 class="m-5 text-2xl font-bold" style="margin-right: auto;">Order Payment</h1>
            <div style="width: 19%;" class="card justify-center flex gap-5 mb-3 p-4 bg-yellow-100 border border-gray-100 rounded-lg shadow">
              <div class="content">
                <p class="font-bold font-normal text-black-500">Total Order</p>
                <strong style="font-size: 25px">200+</strong>
              </div>
            </div>
          </div>
          <table class="min-w-full w-full bg-white shadow-md border border-gray-200">
            <thead class="bg-gray-800 text-white">
              <tr>
                <th scope="col" class="px-4 py-3 text-left text-xs font-medium uppercase tracking-wider">ID</th>
                <th scope="col" class="px-4 py-3 text-left text-xs font-medium uppercase tracking-wider">Customer Name</th>
                <th scope="col" class="px-4 py-3 text-left text-xs font-medium uppercase tracking-wider">Customer Email</th>
                <th scope="col" class="px-4 py-3 text-left text-xs font-medium uppercase tracking-wider">Amount</th>
                <th scope="col" class="px-4 py-3 text-left text-xs font-medium uppercase tracking-wider">Method</th>
                <th scope="col" class="px-4 py-3 text-left text-xs font-medium uppercase tracking-wider">Currency</th>
                <th scope="col" class="px-4 py-3 text-left text-xs font-medium uppercase tracking-wider">Code</th>
                <th scope="col" class="px-4 py-3 text-left text-xs font-medium uppercase tracking-wider">Payment Date</th>
              </tr>
            </thead>
            <tbody id="order-rows" class="divide-y divide-gray-200">
              <!-- Initial Order rows will be inserted here -->
            </tbody>
          </table>
          <button id="show-more-order" class="mt-3 px-4 py-2 bg-blue-500 text-white rounded">Show More</button>
        </div>
      </div>
    </div>
  </div>

  <script>
    document.addEventListener('DOMContentLoaded', () => {
      const bookingRows = [
        { id: 1, customer_name: 'Heang Heang', customer_email: 'heang@gmail.com', amount: '24', method: 'QR', currency: 'USD', code: '123456789', payment_date: '2024-07-08' },
        { id: 2, customer_name: 'John Doe', customer_email: 'john@gmail.com', amount: '30', method: 'Credit Card', currency: 'USD', code: '987654321', payment_date: '2024-07-09' },
        { id: 3, customer_name: 'Jane Doe', customer_email: 'jane@gmail.com', amount: '45', method: 'PayPal', currency: 'USD', code: '456789123', payment_date: '2024-07-10' },
        { id: 4, customer_name: 'Alice', customer_email: 'alice@gmail.com', amount: '50', method: 'Bank Transfer', currency: 'USD', code: '654321987', payment_date: '2024-07-11' },
        { id: 5, customer_name: 'Bob', customer_email: 'bob@gmail.com', amount: '60', method: 'QR', currency: 'USD', code: '321987654', payment_date: '2024-07-12' },
      ];

      const orderRows = [
        { id: 1, customer_name: 'Heang Heang', customer_email: 'heang@gmail.com', amount: '24', method: 'QR', currency: 'USD', code: '123456789', payment_date: '2024-07-08' },
        { id: 2, customer_name: 'John Doe', customer_email: 'john@gmail.com', amount: '30', method: 'Credit Card', currency: 'USD', code: '987654321', payment_date: '2024-07-09' },
        { id: 3, customer_name: 'Jane Doe', customer_email: 'jane@gmail.com', amount: '45', method: 'PayPal', currency: 'USD', code: '456789123', payment_date: '2024-07-10' },
        { id: 4, customer_name: 'Alice', customer_email: 'alice@gmail.com', amount: '50', method: 'Bank Transfer', currency: 'USD', code: '654321987', payment_date: '2024-07-11' },
        { id: 5, customer_name: 'Bob', customer_email: 'bob@gmail.com', amount: '60', method: 'QR', currency: 'USD', code: '321987654', payment_date: '2024-07-12' },
      ];

      const bookingRowsContainer = document.getElementById('booking-rows');
      const orderRowsContainer = document.getElementById('order-rows');
      const showMoreBookingButton = document.getElementById('show-more-booking');
      const showMoreOrderButton = document.getElementById('show-more-order');

      const rowsPerLoad = 4;

      const renderRows = (rows, container, limit) => {
        container.innerHTML = ''; // Clear the container
        const fragment = document.createDocumentFragment();
        for (let i = 0; i < limit && i < rows.length; i++) {
          const row = rows[i];
          const tr = document.createElement('tr');
          tr.innerHTML = `
            <td class="px-4 py-4 whitespace-nowrap">${row.id}</td>
            <td class="px-4 py-4 whitespace-nowrap">${row.customer_name}</td>
            <td class="px-4 py-4 whitespace-nowrap">${row.customer_email}</td>
            <td class="px-4 py-4 whitespace-nowrap">${row.amount}</td>
            <td class="px-4 py-4 whitespace-nowrap">${row.method}</td>
            <td class="px-4 py-4 whitespace-nowrap">${row.currency}</td>
            <td class="px-4 py-4 whitespace-nowrap">${row.code}</td>
            <td class="px-4 py-4 whitespace-nowrap">${row.payment_date}</td>
          `;
          fragment.appendChild(tr);
        }
        container.appendChild(fragment);
      };

      const toggleShowMore = (button, rows, container) => {
        if (button.innerText === 'Show More') {
          renderRows(rows, container, rows.length);
          button.innerText = 'Show Less';
        } else {
          renderRows(rows, container, rowsPerLoad);
          button.innerText = 'Show More';
        }
      };

      renderRows(bookingRows, bookingRowsContainer, rowsPerLoad);
      renderRows(orderRows, orderRowsContainer, rowsPerLoad);

      showMoreBookingButton.addEventListener('click', () => {
        toggleShowMore(showMoreBookingButton, bookingRows, bookingRowsContainer);
      });

      showMoreOrderButton.addEventListener('click', () => {
        toggleShowMore(showMoreOrderButton, orderRows, orderRowsContainer);
      });
    });
  </script>
</x-app-layout>

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
              @foreach($payments as $index => $payment)
              <tr>
                <td class="px-4 py-4 whitespace-nowrap">{{ $index+1 }}</td>
                <td class="px-4 py-4 whitespace-nowrap">{{ $payment->customer->name }}</td>
                <td class="px-4 py-4 whitespace-nowrap">{{  $payment->customer->email }}</td>
                <td class="px-4 py-4 whitespace-nowrap">{{ $payment->amount}}</td>
                <td class="px-4 py-4 whitespace-nowrap">{{ $payment->payment_date}}</td>
                <td class="px-4 py-4 whitespace-nowrap">{{ $payment->code}}</td>
                <td class="px-4 py-4 whitespace-nowrap">{{ $payment->method}}</td>
                <td class="px-4 py-4 whitespace-nowrap">{{ $payment->currency}}</td>
              </tr>
              @endforeach
            </tbody>
          </table>
          <button id="show-more-booking" class="mt-3 px-4 py-2 bg-blue-500 text-white rounded">Show More</button>
        </div>
      </div>

      <hr class="m-5">

      
    </div>
  </div>

  <script>
   
  </script>
</x-app-layout>

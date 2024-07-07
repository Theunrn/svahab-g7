<x-app-layout>
  <div>
    <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-200">
      <div class="container mx-auto px-6 py-1 pb-16">
        <div class="bg-white shadow-md rounded my-6 p-5">
          <form method="POST" action="{{ route('admin.users.store')}}" enctype="multipart/form-data">
            @csrf
            <div class="flex flex-col space-y-2">
              <label for="name" class="text-gray-700 font-medium">User Name</label>
              <input id="name" type="text" name="name" value="{{ old('name') }}" placeholder="Enter name" class="px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-200" />
            </div>

            <div class="flex flex-col space-y-2">
              <label for="email" class="text-gray-700 font-medium">Email</label>
              <input id="email" type="text" name="email" value="{{ old('email') }}" placeholder="Enter email" class="px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-200" />
            </div>

            <div class="flex flex-col space-y-2">
              <label for="phone_number" class="text-gray-700 font-medium">Phone Number</label>
              <input id="phone_number" type="text" name="phone_number" value="{{ old('phone_number') }}" placeholder="Enter Phone Number" class="px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-200" />
            </div>

            <div class="flex flex-col space-y-2">
              <label for="qr" class="text-gray-700 font-medium">Upload Your QR</label>
              <input type="file" id="qr" name="qr" class="px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-200">
            </div>

            <div class="flex flex-col space-y-2">
              <label for="password" class="text-gray-700 font-medium">Password</label>
              <input id="password" type="password" name="password" value="{{ old('password') }}" placeholder="Enter password" class="px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-200" />
            </div>

            <div class="flex flex-col space-y-2">
              <label for="password_confirmation" class="text-gray-700 font-medium">Confirm Password</label>
              <input id="password_confirmation" type="password" name="password_confirmation" placeholder="Re-enter password" class="px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-200" />
            </div>

            <div class="text-center mt-16 mb-16">
              <button type="submit" class="bg-blue-500 text-white font-bold px-5 py-1 rounded focus:outline-none shadow hover:bg-blue-600 transition-colors">Submit</button>
            </div>
          </form>
        </div>
      </div>
    </main>
  </div>
</x-app-layout>
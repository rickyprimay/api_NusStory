<x-layout>
  <section class="bg-gray-100 min-h-screen flex items-center justify-center">
    <div class="w-full max-w-md bg-white rounded-xl shadow-md p-8 space-y-6">
      <h1 class="text-2xl font-bold text-center text-gray-900">
        NusStory
      </h1>
      <h2 class="text-lg font-medium  text-gray-700">
        Masuk ke akun anda
      </h2>
      
      <form action="{{ route('login') }}" method="POST" class="space-y-5">
        @csrf

        <div>
          <label for="email" class="block mb-1 text-sm font-medium text-gray-700">Email</label>
          <input type="text" name="email" id="email"
                 class="w-full p-2.5 rounded-lg border border-gray-300 bg-gray-50 text-gray-900 focus:ring-blue-500 focus:border-blue-500"
                 placeholder="Masukkan enmail anda" required>
          @error('email')
            <span class="text-red-500 text-sm">{{ $message }}</span>
          @enderror
        </div>

        <div>
          <label for="password" class="block mb-1 text-sm font-medium text-gray-700">Password</label>
          <input type="password" name="password" id="password"
                 class="w-full p-2.5 rounded-lg border border-gray-300 bg-gray-50 text-gray-900 focus:ring-blue-500 focus:border-blue-500"
                 placeholder="••••••••" required>
          @error('password')
            <span class="text-red-500 text-sm">{{ $message }}</span>
          @enderror
        </div>

        <button type="submit"
                class="w-full py-2.5 px-4 text-white bg-blue-600 hover:bg-blue-700 rounded-lg font-medium transition duration-200">
          Masuk
        </button>
      </form>
    </div>
  </section>
</x-layout>

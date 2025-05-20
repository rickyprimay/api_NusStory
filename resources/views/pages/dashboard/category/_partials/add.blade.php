<x-layout>
  <div class="p-8">
      <div class="flex justify-between items-center mb-6">
          <h1 class="text-black font-bold text-2xl">Tambah Kategori</h1>
      </div>

      <form action="{{ route('categories.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
          @csrf
          <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
              <div>
                  <label for="name" class="block mb-2 text-sm font-medium text-gray-900">Nama Kategori</label>
                  <input type="text" name="name" id="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
              </div>
              <div>
                  <label for="image" class="block mb-2 text-sm font-medium text-gray-900">Gambar</label>
                  <input type="file" name="image" id="image" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none" accept="image/*" required>
              </div>
          </div>
          <div class="flex justify-end space-x-4">
              <a href="{{ route('categories.index') }}" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10">
                  Batal
              </a>
              <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                  Simpan
              </button>
          </div>
      </form>
  </div>
</x-layout>
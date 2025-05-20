<div class="max-w-full overflow-x-auto">
  <table class="w-full table-auto">
      <thead>
          <tr class="bg-gray-400 text-left">
              <th class="min-w-[50px] px-4 py-4 font-medium text-black">No</th>
              <th class="min-w-[150px] px-4 py-4 font-medium text-black">Nama Kategori</th>
              <th class="min-w-[150px] px-4 py-4 font-medium text-black">Gambar</th>
              <th class="px-4 py-4 font-medium text-black">Aksi</th>
          </tr>
      </thead>
      <tbody>
          @forelse ($categories as $category)
              <tr>
                  <td class="border-b px-4 py-5">
                      <p class="text-black">{{ $loop->iteration }}</p>
                  </td>
                  <td class="border-b px-4 py-5">
                      <p class="text-black">{{ $category->name }}</p>
                  </td>
                  <td class="border-b px-4 py-5">
                      <img src="{{ $category->image }}" alt="Gambar" class="w-20 h-20 rounded-lg">
                  </td>
                  <td class="border-b px-4 py-5">
                      <div class="flex items-center space-x-3.5">
                        <a href="{{ route('categories.edit', $category->id) }}" class="hover:text-primary" >
                            <i class="fa-solid fa-pencil text-blue-500"></i>
                        </a>
                          <button data-modal-target="delete-modal-{{ $category->id }}" data-modal-toggle="delete-modal-{{ $category->id }}" class="hover:text-primary">
                              <i class="fas fa-trash-alt text-red-500"></i>
                          </button>
                      </div>
                  </td>
              </tr>
          @empty
              <tr>
                  <td colspan="4" class="text-center px-4 py-5 text-gray-500">
                      Tidak ada Topik Histori.
                  </td>
              </tr>
          @endforelse
      </tbody>
  </table>
</div>

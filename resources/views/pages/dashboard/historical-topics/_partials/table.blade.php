<div class="max-w-full overflow-x-auto">
  <table class="w-full table-auto">
      <thead>
          <tr class="bg-gray-400 text-left">
              <th class="min-w-[50px] px-4 py-4 font-medium text-black">No</th>
              <th class="min-w-[150px] px-4 py-4 font-medium text-black">Nama Kategori</th>
              <th class="min-w-[150px] px-4 py-4 font-medium text-black">Deskripsi</th>
              <th class="min-w-[150px] px-4 py-4 font-medium text-black">Konten</th>
              <th class="min-w-[150px] px-4 py-4 font-medium text-black">Mulai Pada</th>
              <th class="min-w-[150px] px-4 py-4 font-medium text-black">Selesai Pada</th>
              <th class="min-w-[150px] px-4 py-4 font-medium text-black">Thumbnail</th>
              <th class="min-w-[150px] px-4 py-4 font-medium text-black">Link Video</th>
              <th class="min-w-[150px] px-4 py-4 font-medium text-black">Provinsi</th>
              <th class="min-w-[150px] px-4 py-4 font-medium text-black">Kota</th>
              <th class="px-4 py-4 font-medium text-black">Aksi</th>
          </tr>
      </thead>
      <tbody>
          @forelse ($historicalTopics as $historicalTopic)
              <tr>
                  <td class="border-b px-4 py-5">
                      <p class="text-black">{{ $loop->iteration }}</p>
                  </td>
                  <td class="border-b px-4 py-5">
                      <p class="text-black">{{ $historicalTopic->title }}</p>
                  </td>
                  <td class="border-b px-4 py-5">
                      <p class="text-black">{{ \Illuminate\Support\Str::limit($historicalTopic->description, 50) }}</p>
                  </td>
                  <td class="border-b px-4 py-5">
                    <span class="text-black">
                        {{ \Illuminate\Support\Str::limit(strip_tags($historicalTopic->content), 50) }}
                    </span>                    
                  </td>                
                  <td class="border-b px-4 py-5">
                      <p class="text-black">{{ $historicalTopic->start_year }}</p>
                  </td>
                  <td class="border-b px-4 py-5">
                      <p class="text-black">{{ $historicalTopic->end_year }}</p>
                  </td>
                  <td class="border-b px-4 py-5">
                      <img src="{{ $historicalTopic->thumbnail }}" alt="Gambar" class="w-20 h-20 rounded-lg">
                  </td>
                  <td class="border-b px-4 py-5">
                      <a target="_blank" href="{{ $historicalTopic->video_url }}" class="text-black hover:text-primary">Link Video</a>
                  </td>
                  <td class="border-b px-4 py-5">
                      <p class="text-black">{{ $historicalTopic->province->name }}</p>
                  </td>
                  <td class="border-b px-4 py-5">
                      <p class="text-black">{{ $historicalTopic->city->name }}</p>
                  </td>
                  <td class="border-b px-4 py-5">
                      <div class="flex items-center space-x-3.5">
                        <a href="{{ route('historical-topics.edit', $historicalTopic->id) }}" class="hover:text-primary" >
                            <i class="fa-solid fa-pencil text-blue-500"></i>
                        </a>
                          <button data-modal-target="delete-modal-{{ $historicalTopic->id }}" data-modal-toggle="delete-modal-{{ $historicalTopic->id }}" class="hover:text-primary">
                              <i class="fas fa-trash-alt text-red-500"></i>
                          </button>
                      </div>
                  </td>
              </tr>
          @empty
              <tr>
                  <td colspan="6" class="text-center px-4 py-5 text-gray-500">
                      Tidak ada Topik Histori.
                  </td>
              </tr>
          @endforelse
      </tbody>
  </table>
</div>

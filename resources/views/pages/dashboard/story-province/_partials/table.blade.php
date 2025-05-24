<div class="max-w-full overflow-x-auto">
    <table class="w-full table-auto">
        <thead>
            <tr class="bg-gray-400 text-left">
                <th class="min-w-[50px] px-4 py-4 font-medium text-black">No</th>
                <th class="min-w-[150px] px-4 py-4 font-medium text-black">Nama Provinsi</th>
                <th class="min-w-[150px] px-4 py-4 font-medium text-black">Subtitle</th>
                <th class="min-w-[150px] px-4 py-4 font-medium text-black">Koordinat</th>
                <th class="px-4 py-4 font-medium text-black">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($provinces as $province)
                <tr>
                    <td class="border-b px-4 py-5">
                        <p class="text-black">{{ $loop->iteration }}</p>
                    </td>
                    <td class="border-b px-4 py-5">
                        <p class="text-black">{{ $province->name }}</p>
                    </td>
                    <td class="border-b px-4 py-5">
                        <p class="text-black">{{ $province->subtitle }}</p>
                    </td>
                    <td class="border-b px-4 py-5">
                        <p class="text-black">{{ $province->latitude }}, {{ $province->longitude }}</p>
                    </td>
                    <td class="border-b px-4 py-5">
                        <div class="flex items-center space-x-3.5">
                            <a href="{{ route('dashboard.story-provinces.show', $province->id) }}" class="hover:text-primary">
                                <i class="fas fa-eye text-blue-500"></i>
                            </a>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center px-4 py-5 text-gray-500">
                        Tidak ada data Provinsi.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

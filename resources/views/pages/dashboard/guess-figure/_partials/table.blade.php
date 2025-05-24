<div class="max-w-full overflow-x-auto">
    <table class="w-full table-auto">
        <thead>
            <tr class="bg-gray-400 text-left">
                <th class="min-w-[50px] px-4 py-4 font-medium text-black">No</th>
                <th class="min-w-[150px] px-4 py-4 font-medium text-black">Judul Quiz</th>
                <th class="min-w-[150px] px-4 py-4 font-medium text-black">Deskripsi</th>
                <th class="min-w-[150px] px-4 py-4 font-medium text-black">Kategori</th>
                <th class="min-w-[100px] px-4 py-4 font-medium text-black">Jumlah Soal</th>
                <th class="px-4 py-4 font-medium text-black">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($quizzes as $quiz)
                <tr>
                    <td class="border-b px-4 py-5">
                        <p class="text-black">{{ $loop->iteration }}</p>
                    </td>
                    <td class="border-b px-4 py-5">
                        <p class="text-black">{{ $quiz->title }}</p>
                    </td>
                    <td class="border-b px-4 py-5">
                        <p class="text-black">{{ Str::limit($quiz->description, 50) }}</p>
                    </td>
                    <td class="border-b px-4 py-5">
                        <p class="text-black">{{ $quiz->category->name }}</p>
                    </td>
                    <td class="border-b px-4 py-5">
                        <p class="text-black">{{ $quiz->questions->count() }}</p>
                    </td>
                    <td class="border-b px-4 py-5">
                        <div class="flex items-center space-x-3.5">
                            <a href="{{ route('guess-figure.show', $quiz->id) }}" class="hover:text-primary">
                                <i class="fas fa-eye text-blue-500"></i>
                            </a>
                            <a href="{{ route('guess-figure.edit', $quiz->id) }}" class="hover:text-primary">
                                <i class="fa-solid fa-pencil text-blue-500"></i>
                            </a>
                            <button data-modal-target="delete-modal-{{ $quiz->id }}" data-modal-toggle="delete-modal-{{ $quiz->id }}" class="hover:text-primary">
                                <i class="fas fa-trash-alt text-red-500"></i>
                            </button>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center px-4 py-5 text-gray-500">
                        Tidak ada Quiz.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div> 
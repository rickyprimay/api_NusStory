<x-layout>
    <div class="p-8">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-black font-bold text-2xl">{{ $quiz->title }}</h1>
            <div class="flex space-x-4">
                <a href="{{ route('guess-figure.edit', $quiz->id) }}" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5">
                    Edit Quiz
                </a>
                <a href="{{ route('guess-figure.index') }}" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10">
                    Kembali
                </a>
            </div>
        </div>

        @if($quiz->description)
            <div class="mb-6">
                <h2 class="text-lg font-medium text-gray-900 mb-2">Deskripsi</h2>
                <p class="text-gray-700">{{ $quiz->description }}</p>
            </div>
        @endif

        <div class="mb-6">
            <h2 class="text-lg font-medium text-gray-900 mb-2">Kategori</h2>
            <p class="text-gray-700">{{ $quiz->category->name }}</p>
        </div>

        <div class="space-y-6">
            <h2 class="text-lg font-medium text-gray-900">Daftar Pertanyaan</h2>
            @foreach($quiz->questions as $question)
                <div class="border rounded-lg p-4">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <h3 class="text-md font-medium text-gray-900 mb-2">Tokoh Sejarah</h3>
                            <p class="text-gray-700">{{ $question->historicalFigure->name }}</p>
                        </div>
                        <div>
                            <h3 class="text-md font-medium text-gray-900 mb-2">Gambar</h3>
                            @if($question->image)
                                <img src="{{ asset('storage/' . $question->image) }}" alt="Question Image" class="w-32 h-32 rounded-lg object-cover">
                            @endif
                        </div>
                        @if($question->hint)
                            <div>
                                <h3 class="text-md font-medium text-gray-900 mb-2">Petunjuk</h3>
                                <p class="text-gray-700">{{ $question->hint }}</p>
                            </div>
                        @endif
                        <div>
                            <h3 class="text-md font-medium text-gray-900 mb-2">Urutan</h3>
                            <p class="text-gray-700">{{ $question->order }}</p>
                        </div>
                    </div>
                    <div class="mt-4">
                        <h3 class="text-md font-medium text-gray-900 mb-2">Lokasi yang Benar</h3>
                        <div id="map-{{ $question->id }}" class="h-64 rounded-lg"></div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    @push('styles')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    @endpush

    @push('scripts')
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            @foreach($quiz->questions as $question)
                const map{{ $question->id }} = L.map('map-{{ $question->id }}').setView([{{ $question->correct_latitude }}, {{ $question->correct_longitude }}], 5);
                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    attribution: '© OpenStreetMap contributors'
                }).addTo(map{{ $question->id }});

                L.marker([{{ $question->correct_latitude }}, {{ $question->correct_longitude }}]).addTo(map{{ $question->id }});
            @endforeach
        });
    </script>
    @endpush
</x-layout> 
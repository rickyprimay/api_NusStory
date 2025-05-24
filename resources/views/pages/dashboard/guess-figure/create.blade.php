<x-layout>
    <div class="p-8">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-black font-bold text-2xl">Tambah Quiz Tebak Tokoh</h1>
        </div>

        <form action="{{ route('guess-figure.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            <div class="grid grid-cols-1 gap-6">
                <div>
                    <label for="title" class="block mb-2 text-sm font-medium text-gray-900">Judul Quiz</label>
                    <input type="text" name="title" id="title" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
                </div>
                <div>
                    <label for="description" class="block mb-2 text-sm font-medium text-gray-900">Deskripsi</label>
                    <textarea name="description" id="description" rows="3" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"></textarea>
                </div>
                <div>
                    <label for="category_id" class="block mb-2 text-sm font-medium text-gray-900">Kategori</label>
                    <select name="category_id" id="category_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
                        <option value="">Pilih Kategori</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div id="questions-container">
                <div class="mb-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Pertanyaan</h3>
                    <div class="space-y-6">
                        <div class="question-item border rounded-lg p-4">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label class="block mb-2 text-sm font-medium text-gray-900">Tokoh Sejarah</label>
                                    <select name="questions[0][historical_figure_id]" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
                                        <option value="">Pilih Tokoh</option>
                                        @foreach($historicalFigures as $figure)
                                            <option value="{{ $figure->id }}">{{ $figure->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div>
                                    <label class="block mb-2 text-sm font-medium text-gray-900">Gambar</label>
                                    <input type="file" name="questions[0][image]" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none" accept="image/*" required>
                                </div>
                                <div>
                                    <label class="block mb-2 text-sm font-medium text-gray-900">Petunjuk</label>
                                    <input type="text" name="questions[0][hint]" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                </div>
                                <div>
                                    <label class="block mb-2 text-sm font-medium text-gray-900">Urutan</label>
                                    <input type="number" name="questions[0][order]" value="0" min="0" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
                                </div>
                            </div>
                            <div class="mt-4">
                                <label class="block mb-2 text-sm font-medium text-gray-900">Lokasi yang Benar</label>
                                <div id="map-0" class="h-64 rounded-lg"></div>
                                <input type="hidden" name="questions[0][correct_latitude]" id="latitude-0" required>
                                <input type="hidden" name="questions[0][correct_longitude]" id="longitude-0" required>
                            </div>
                        </div>
                    </div>
                    <button type="button" id="add-question" class="mt-4 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5">
                        Tambah Pertanyaan
                    </button>
                </div>
            </div>

            <div class="flex justify-end space-x-4">
                <a href="{{ route('guess-figure.index') }}" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10">
                    Batal
                </a>
                <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                    Simpan
                </button>
            </div>
        </form>
    </div>

    @push('styles')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    @endpush

    @push('scripts')
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <script>
        let questionCount = 1;
        const maps = {};
        const markers = {};

        function initMap(index) {
            const map = L.map(`map-${index}`).setView([-2.5489, 118.0149], 5);
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '© OpenStreetMap contributors'
            }).addTo(map);

            const marker = L.marker([-2.5489, 118.0149], {
                draggable: true
            }).addTo(map);

            marker.on('dragend', function(event) {
                const position = marker.getLatLng();
                document.getElementById(`latitude-${index}`).value = position.lat;
                document.getElementById(`longitude-${index}`).value = position.lng;
            });

            maps[index] = map;
            markers[index] = marker;
        }

        document.addEventListener('DOMContentLoaded', function() {
            initMap(0);

            document.getElementById('add-question').addEventListener('click', function() {
                const container = document.querySelector('.question-item').cloneNode(true);
                const newIndex = questionCount;

                // Update input names and IDs
                container.querySelectorAll('[name]').forEach(input => {
                    input.name = input.name.replace('[0]', `[${newIndex}]`);
                });
                container.querySelectorAll('[id]').forEach(element => {
                    element.id = element.id.replace('-0', `-${newIndex}`);
                });

                // Clear values
                container.querySelectorAll('input[type="text"], input[type="number"], input[type="file"]').forEach(input => {
                    input.value = '';
                });
                container.querySelector('select').value = '';

                // Add to container
                document.querySelector('.space-y-6').appendChild(container);

                // Initialize new map
                initMap(newIndex);

                questionCount++;
            });
        });
    </script>
    @endpush
</x-layout> 
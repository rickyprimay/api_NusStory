<x-layout>
    <div class="p-8">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-black font-bold text-2xl">Tambah Topik Histori</h1>
        </div>

        <form action="{{ route('historical-topics.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Title -->
                <div>
                    <label for="title" class="block mb-2 text-sm font-medium text-gray-900">Nama Topik</label>
                    <input type="text" name="title" id="title" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
                </div>

                <!-- Description -->
                <div>
                    <label for="description" class="block mb-2 text-sm font-medium text-gray-900">Deskripsi</label>
                    <textarea name="description" id="description" rows="3" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required></textarea>
                </div>

                <!-- Start Year -->
                <div>
                    <label for="start_year" class="block mb-2 text-sm font-medium text-gray-900">Tahun Mulai</label>
                    <input type="number" name="start_year" id="start_year" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
                </div>

                <!-- End Year -->
                <div>
                    <label for="end_year" class="block mb-2 text-sm font-medium text-gray-900">Tahun Selesai</label>
                    <input type="number" name="end_year" id="end_year" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
                </div>

                <!-- Province -->
                <div>
                    <label for="province_id" class="block mb-2 text-sm font-medium text-gray-900">Provinsi</label>
                    <select name="province_id" id="province_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
                        <option value="">Pilih Provinsi</option>
                        @foreach($provinces as $province)
                            <option value="{{ $province->id }}">{{ $province->name }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- City -->
                <div>
                    <label for="city_id" class="block mb-2 text-sm font-medium text-gray-900">Kota</label>
                    <select name="city_id" id="city_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
                        <option value="">Pilih Kota</option>
                    </select>
                </div>

                <!-- Thumbnail -->
                <div>
                    <label for="thumbnail" class="block mb-2 text-sm font-medium text-gray-900">Thumbnail</label>
                    <input type="file" name="thumbnail" id="thumbnail" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none" accept="image/*" required>
                </div>

                <!-- Video URL -->
                <div>
                    <label for="video_url" class="block mb-2 text-sm font-medium text-gray-900">Link Video</label>
                    <input type="url" name="video_url" id="video_url" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
                </div>
            </div>

            <!-- Content with CKEditor -->
            <div>
                <label for="content" class="block mb-2 text-sm font-medium text-gray-900">Konten</label>
                <textarea name="content" id="editor" class="bg-gray-50 border border-gray-300 text-black text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full"></textarea>
            </div>

            <div class="flex justify-end space-x-4">
                <a href="{{ route('historical-topics.index') }}" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10">
                    Batal
                </a>
                <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                    Simpan
                </button>
            </div>
        </form>
    </div>

    @push('scripts')
    <script src="https://cdn.ckeditor.com/ckeditor5/40.0.0/classic/ckeditor.js"></script>
    <script>
        let editor;
        ClassicEditor
            .create(document.querySelector('#editor'), {
                toolbar: ['heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList', '|', 'outdent', 'indent', '|', 'blockQuote'],
                placeholder: 'Tulis konten di sini...',
                removePlugins: ['Title'],
                editorConfig: {
                    contentsCss: [
                        'body { color: #000000; }'
                    ]
                }
            })
            .then(newEditor => {
                editor = newEditor;
                // Set default text color to black
                editor.editing.view.change(writer => {
                    writer.setStyle('color', '#000000', editor.editing.view.document.getRoot());
                });
            })
            .catch(error => {
                console.error(error);
            });

        // Form validation
        document.querySelector('form').addEventListener('submit', function(e) {
            const content = editor.getData();
            if (!content.trim()) {
                e.preventDefault();
                alert('Konten tidak boleh kosong');
                return false;
            }
        });

        document.getElementById('province_id').addEventListener('change', function() {
            const provinceId = this.value;
            const citySelect = document.getElementById('city_id');
            
            citySelect.innerHTML = '<option value="">Pilih Kota</option>';
            
            if (provinceId) {
                fetch(`/api/cities/${provinceId}`)
                    .then(response => response.json())
                    .then(response => {
                        if (response.success && response.data) {
                            response.data.forEach(city => {
                                const option = document.createElement('option');
                                option.value = city.id;
                                option.textContent = city.name;
                                citySelect.appendChild(option);
                            });
                        }
                    })
                    .catch(error => {
                        console.error('Error fetching cities:', error);
                    });
            }
        });
    </script>
    @endpush
</x-layout>
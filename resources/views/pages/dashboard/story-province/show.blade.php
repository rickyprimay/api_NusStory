<x-layout>
    <div class="p-8">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-black font-bold text-2xl">{{ $province->name }}</h1>
            <a href="{{ route('dashboard.story-provinces.index') }}" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10">
                Kembali
            </a>
        </div>

        <div class="bg-white rounded-lg shadow-md p-6 mb-6">
            <h2 class="text-xl font-semibold mb-4">Informasi Provinsi</h2>
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <p class="text-gray-600">Subtitle</p>
                    <p class="font-medium">{{ $province->subtitle }}</p>
                </div>
                <div>
                    <p class="text-gray-600">Koordinat</p>
                    <p class="font-medium">{{ $province->latitude }}, {{ $province->longitude }}</p>
                </div>
            </div>
        </div>

        <div class="flex justify-between items-center mb-6">
            <h2 class="text-xl font-semibold">Detail Provinsi</h2>
            <a href="{{ route('dashboard.story-province-details.create', ['province_id' => $province->id]) }}" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5">
                Tambah Detail
            </a>
        </div>

        @include('pages.dashboard.story-province._partials.details-table')
        @foreach ($province->details as $detail)
            @include('pages.dashboard.story-province._partials.delete-modal')
        @endforeach
    </div>
</x-layout> 
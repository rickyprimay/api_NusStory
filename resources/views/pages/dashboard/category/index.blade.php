<x-layout>
  <div class="p-8">
    <div class="flex justify-between">
        <h1 class="text-black font-bold text-2xl mb-4">Tokoh Kategori</h1>
        <a href="{{ route('categories.create') }}" type="button"
            class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2">
            Tambah Kategori
        </a>
    </div>

    @include('pages.dashboard.category._partials.table')
    @foreach ($categories as $category)
        @include('pages.dashboard.category._partials.delete-modal')
    @endforeach

  </div>
</x-layout>
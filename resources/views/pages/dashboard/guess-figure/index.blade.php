<x-layout>
    <div class="p-8">
        <div class="flex justify-between">
            <h1 class="text-black font-bold text-2xl mb-4">Quiz Tebak Tokoh</h1>
            <a href="{{ route('guess-figure.create') }}" type="button"
                class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2">
                Tambah Quiz
            </a>
        </div>

        @include('pages.dashboard.guess-figure._partials.table')
        @foreach ($quizzes as $quiz)
            @include('pages.dashboard.guess-figure._partials.delete-modal')
        @endforeach
    </div>
</x-layout> 
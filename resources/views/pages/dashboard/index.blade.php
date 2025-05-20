<x-layout>
  <main>
    <div class="mx-auto max-w-screen-2xl p-4 md:p-6 2xl:p-10">
      <div class="bg-blue-100 rounded-xl flex items-center justify-between p-8 relative overflow-hidden">
        <div>
          <h1 class="text-3xl md:text-4xl font-bold text-gray-900 mb-2 flex items-center gap-2">
            {{ \App\Helpers\Time::greeting() }}, {{ session('user_name') }}
            <span class="text-3xl md:text-4xl">👋</span>
          </h1>
          <p class="text-gray-600 text-lg">Here is what's happening with your projects today:</p>
        </div>
        <svg class="absolute right-0 bottom-0 w-48 h-32 opacity-60 pointer-events-none" viewBox="0 0 200 100" fill="none">
          <polygon points="200,0 200,100 100,100" fill="#6366F1" opacity="0.2"/>
          <polygon points="150,0 200,100 100,100" fill="#6366F1" opacity="0.4"/>
          <polygon points="180,20 200,100 120,100" fill="#6366F1" opacity="0.6"/>
        </svg>
      </div>
    </div>
  </main>
</x-layout>

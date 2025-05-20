<!DOCTYPE html>
<html lang="en" class="dark">

<x-header></x-header>

<body 
  x-data="{ page: 'ecommerce', loaded: true, darkMode: true, stickyMenu: false, sidebarToggle: false, scrollTop: false }"
  :class="{ 'dark text-bodydark ': darkMode === true }">

  <div x-show="loaded" 
       x-init="window.addEventListener('DOMContentLoaded', () => { setTimeout(() => loaded = false, 500) })"
       class="fixed left-0 top-0 z-999999 flex h-screen w-screen items-center justify-center bg-white">
    <div class="h-16 w-16 animate-spin rounded-full border-4 border-solid border-primary border-t-transparent"></div>
  </div>

  <div class="flex h-screen overflow-hidden">
    @if (!request()->routeIs('login') && !request()->routeIs('index'))
      <x-sidebar></x-sidebar>
    @endif

    <div class="relative flex flex-1 flex-col overflow-y-auto overflow-x-hidden">
      @if (!request()->routeIs('login') && !request()->routeIs('index'))
        <x-navbar></x-navbar>
      @endif
      {{ $slot }}
    </div>
  </div>

  <script defer src="{{ asset('js/bundle.js') }}"></script>
  @stack('scripts')

  @if (session('error'))
    <script>
      Swal.fire({
        toast: true,
        icon: 'error',
        title: '{{ session('error') }}',
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000
      });
    </script>
  @endif

  @if (session('success'))
    <script>
      Swal.fire({
        toast: true,
        icon: 'success',
        title: '{{ session('success') }}',
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000
      });
    </script>
  @endif
</body>

</html>

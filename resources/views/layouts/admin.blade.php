<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Panel</title>

    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif
</head>
<body class="min-h-screen bg-gray-100 flex">

    <!-- Sidebar -->
    <aside class="w-64 bg-white shadow h-screen fixed flex flex-col">
    <div class="p-6 space-y-6">
        <h2 class="text-xl font-bold mb-6">Admin Panel</h2>

        <nav class="space-y-2">
            <a href="{{ route('admin.dashboard') }}"
               class="block px-4 py-2 rounded hover:bg-gray-100 {{ request()->routeIs('admin.dashboard') ? 'bg-gray-100 font-semibold' : '' }}">
                Dashboard
            </a>

            <a href="{{ route('admin.categories.index') }}"
               class="block px-4 py-2 rounded hover:bg-gray-100 {{ request()->routeIs('admin.categories.*') ? 'bg-gray-100 font-semibold' : '' }}">
                Categories
            </a>

            <a href="{{ route('admin.posts.index') }}"
               class="block px-4 py-2 rounded hover:bg-gray-100 {{ request()->routeIs('admin.posts.*') ? 'bg-gray-100 font-semibold' : '' }}">
                Posts
            </a>

            <a href="{{ route('admin.users.index') }}"
               class="block px-4 py-2 rounded hover:bg-gray-100 {{ request()->routeIs('admin.users.*') ? 'bg-gray-100 font-semibold' : '' }}">
                Users
            </a>

            <a href="{{ route('admin.activity-logs.index') }}"
               class="block px-4 py-2 rounded hover:bg-gray-100 {{ request()->routeIs('admin.activity-logs.*') ? 'bg-gray-100 font-semibold' : '' }}">
                Activity Logs
            </a>
        </nav>
    </div>

    {{-- Logout ثابت أسفل الشاشة --}}
    <div class="absolute bottom-0 w-full p-6">
        <form method="POST" action="{{ route('admin.logout') }}">
            @csrf
            <button type="submit" class="w-full text-left px-4 py-2 rounded hover:bg-gray-100 text-red-600">
                Logout
            </button>
        </form>
    </div>
</aside>


    <!-- Page Content -->
    <main class="flex-1 ml-64 p-6">
        @yield('content')
    </main>

</body>

</html>

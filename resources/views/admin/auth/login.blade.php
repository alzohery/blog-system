<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Login</title>
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif
</head>
<body class="min-h-screen bg-gray-100 flex items-center justify-center">

    <div class="w-full max-w-md bg-white rounded-xl shadow-lg p-8">

        <h1 class="text-2xl font-semibold text-gray-800 text-center mb-4">Admin Login</h1>
        <p class="text-gray-500 text-sm text-center mb-6">Enter your credentials to access the dashboard</p>

        {{-- Error Messages --}}
        @if($errors->any())
            <div class="mb-4 p-4 bg-red-100 text-red-800 rounded-lg">
                <ul class="list-disc list-inside">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('admin.login') }}" class="space-y-6">
            @csrf

            {{-- Email --}}
            <div>
                <label class="block text-sm font-medium text-gray-700">Email</label>
                <input type="email"
                       name="email"
                       value="{{ old('email') }}"
                       required
                       class="mt-1 w-full rounded-lg border border-gray-200 px-3 py-2
                              text-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-100
                              focus:outline-none">
            </div>

            {{-- Password --}}
            <div>
                <label class="block text-sm font-medium text-gray-700">Password</label>
                <input type="password"
                       name="password"
                       required
                       class="mt-1 w-full rounded-lg border border-gray-200 px-3 py-2
                              text-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-100
                              focus:outline-none">
            </div>

            {{-- Submit Button --}}
            <div>
                <button type="submit"
                        class="w-full px-4 py-2 bg-blue-600 text-white rounded-lg
                               hover:bg-blue-700 transition font-medium">
                    Login
                </button>
            </div>
        </form>

        <p class="mt-6 text-gray-400 text-center text-sm">
            &copy; {{ date('Y') }} Admin Panel
        </p>

    </div>

</body>
</html>

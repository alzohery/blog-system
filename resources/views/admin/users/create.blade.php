@extends('layouts.admin')

@section('content')
<div class="max-w-4xl mx-auto p-6 space-y-6">

    {{-- Header --}}
    <div>
        <h1 class="text-2xl font-semibold text-gray-800">Create User</h1>
        <p class="text-gray-500 text-sm">Add a new system user.</p>
    </div>

    {{-- Error Message --}}
    @if($errors->any())
        <div class="p-4 bg-red-100 text-red-800 rounded-lg">
            {{ $errors->first() }}
        </div>
    @endif

    {{-- Form --}}
    <form method="POST"
          action="{{ route('admin.users.store') }}"
          class="bg-white p-6 rounded-xl shadow space-y-6">
        @csrf

        {{-- Name --}}
        <div>
            <label class="block text-sm font-medium text-gray-700">Name</label>
            <input type="text"
                   name="name"
                   value="{{ old('name') }}"
                   class="mt-1 w-full rounded-lg border border-gray-200
                          px-3 py-2 text-sm
                          focus:border-blue-500
                          focus:ring-2 focus:ring-blue-100
                          focus:outline-none">
        </div>

        {{-- Email --}}
        <div>
            <label class="block text-sm font-medium text-gray-700">Email</label>
            <input type="email"
                   name="email"
                   value="{{ old('email') }}"
                   class="mt-1 w-full rounded-lg border border-gray-200
                          px-3 py-2 text-sm
                          focus:border-blue-500
                          focus:ring-2 focus:ring-blue-100
                          focus:outline-none">
        </div>

        {{-- Password --}}
        <div>
            <label class="block text-sm font-medium text-gray-700">Password</label>
            <input type="password"
                   name="password"
                   class="mt-1 w-full rounded-lg border border-gray-200
                          px-3 py-2 text-sm
                          focus:border-blue-500
                          focus:ring-2 focus:ring-blue-100
                          focus:outline-none">
        </div>

        {{-- Status --}}
        <div class="flex items-center gap-2">
            <input type="checkbox"
                   name="is_active"
                   value="1"
                   checked
                   class="rounded border-gray-300 text-blue-600
                          focus:ring-2 focus:ring-blue-200">
            <label class="text-sm text-gray-700">Active</label>
        </div>

        {{-- Actions --}}
        <div class="flex items-center gap-3">
            <button type="submit"
                    class="px-6 py-2 rounded-lg bg-blue-600 text-white
                           hover:bg-blue-700 transition">
                Save User
            </button>

            <a href="{{ route('admin.users.index') }}"
               class="text-sm text-gray-600 hover:text-gray-900 hover:underline">
                Cancel
            </a>
        </div>
    </form>

</div>
@endsection

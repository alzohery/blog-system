@extends('layouts.admin')

@section('content')
<div class="max-w-7xl mx-auto p-6 space-y-6">

    <h1 class="text-2xl font-semibold text-gray-800">Dashboard</h1>

    {{-- Stats --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-6">

        {{-- Users --}}
        <div class="bg-white rounded shadow p-5">
            <p class="text-sm text-gray-500">Users</p>
            <p class="text-2xl font-bold text-gray-800">
                {{ $stats['users_count'] }}
            </p>
        </div>

        {{-- Posts --}}
        <div class="bg-white rounded shadow p-5">
            <p class="text-sm text-gray-500">Posts</p>
            <p class="text-2xl font-bold text-gray-800">
                {{ $stats['posts_count'] }}
            </p>
        </div>

        {{-- Published --}}
        <div class="bg-white rounded shadow p-5">
            <p class="text-sm text-gray-500">Published</p>
            <p class="text-2xl font-bold text-green-600">
                {{ $stats['published_posts'] }}
            </p>
        </div>

        {{-- Scheduled --}}
        <div class="bg-white rounded shadow p-5">
            <p class="text-sm text-gray-500">Scheduled</p>
            <p class="text-2xl font-bold text-yellow-600">
                {{ $stats['scheduled_posts'] }}
            </p>
        </div>

        {{-- Categories --}}
        <div class="bg-white rounded shadow p-5">
            <p class="text-sm text-gray-500">Categories</p>
            <p class="text-2xl font-bold text-blue-600">
                {{ $stats['categories_count'] }}
            </p>
        </div>

    </div>

</div>
@endsection

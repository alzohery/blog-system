@extends('layouts.admin')

@section('content')
<div class="max-w-7xl mx-auto p-6 space-y-6">

    {{-- Header --}}
    <div class="flex items-center justify-between">
        <h1 class="text-2xl font-semibold text-gray-800">Posts</h1>

        <a href="{{ route('admin.posts.create') }}"
           class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition">
            + Create Post
        </a>
    </div>

    {{-- Success Message --}}
    @if(session('success'))
        <div class="p-4 bg-green-100 text-green-800 rounded">
            {{ session('success') }}
        </div>
    @endif

    {{-- Filters --}}
    <form method="GET"
          action="{{ route('admin.posts.index') }}"
          class="bg-white p-4 rounded-xl shadow flex flex-wrap gap-4 items-end">

        <div>
            <label class="block text-sm text-gray-600">Title</label>
            <input type="text"
                   name="title"
                   value="{{ request('title') }}"
                   class="mt-1 w-48 rounded border border-gray-200 px-3 py-2 text-sm focus:ring-2 focus:ring-blue-100 focus:border-blue-500"
                   placeholder="Search title">
        </div>

        <div>
            <label class="block text-sm text-gray-600">Status</label>
            <select name="status"
                    class="mt-1 w-40 rounded border border-gray-200 px-3 py-2 text-sm focus:ring-2 focus:ring-blue-100 focus:border-blue-500">
                <option value="">All</option>
                <option value="draft" @selected(request('status') === 'draft')>Draft</option>
                <option value="scheduled" @selected(request('status') === 'scheduled')>Scheduled</option>
                <option value="published" @selected(request('status') === 'published')>Published</option>
            </select>
        </div>

        <div>
            <label class="block text-sm text-gray-600">Category</label>
            <select name="category_id"
                    class="mt-1 w-48 rounded border border-gray-200 px-3 py-2 text-sm focus:ring-2 focus:ring-blue-100 focus:border-blue-500">
                <option value="">All</option>
                @foreach(\App\Modules\Categories\Models\Category::all() as $category)
                    <option value="{{ $category->id }}" @selected(request('category_id') == $category->id)>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="flex gap-2">
            <button type="submit"
                    class="px-4 py-2 bg-gray-800 text-white rounded hover:bg-black transition">
                Filter
            </button>

            <a href="{{ route('admin.posts.index') }}"
               class="px-4 py-2 bg-gray-200 rounded hover:bg-gray-300 transition">
                Reset
            </a>
        </div>
    </form>

    {{-- Table --}}
    <div class="overflow-x-auto bg-white rounded-xl shadow">
        <table class="min-w-full text-sm">
            <thead class="bg-gray-50 border-b">
                <tr>
                    <th class="px-6 py-3 text-left font-medium text-gray-600">Title</th>
                    <th class="px-6 py-3 text-left font-medium text-gray-600">Category</th>
                    <th class="px-6 py-3 text-left font-medium text-gray-600">Status</th>
                    <th class="px-6 py-3 text-left font-medium text-gray-600">Publish At</th>
                    <th class="px-6 py-3 text-left font-medium text-gray-600">Image</th>
                    <th class="px-6 py-3 text-left font-medium text-gray-600">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($posts as $post)
                    <tr class="hover:bg-gray-50 even:bg-gray-50 transition">
                        <td class="px-6 py-4 text-gray-800">{{ $post->title }}</td>
                        <td class="px-6 py-4 text-gray-600">{{ $post->category->name }}</td>
                        <td class="px-6 py-4">
                            <span class="px-2 py-1 rounded text-xs
                                @if($post->status === 'published') bg-green-100 text-green-700
                                @elseif($post->status === 'scheduled') bg-yellow-100 text-yellow-700
                                @else bg-gray-200 text-gray-700
                                @endif">
                                {{ ucfirst($post->status) }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-gray-600">{{ $post->publish_at ?? '-' }}</td>
                        <td class="px-6 py-4">
                            @if($post->main_image)
                                <img src="{{ asset('storage/' . $post->main_image) }}" class="w-16 h-10 object-cover rounded">
                            @else
                                -
                            @endif
                        </td>
                        <td class="px-6 py-4 space-x-2">
                            <a href="{{ route('admin.posts.edit', $post) }}"
                               class="px-3 py-1 text-xs font-medium text-blue-700 bg-blue-50 rounded hover:bg-blue-100 transition">
                                Edit
                            </a>

                            <form action="{{ route('admin.posts.destroy', $post) }}"
                                  method="POST"
                                  class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        onclick="return confirm('Are you sure?')"
                                        class="px-3 py-1 text-xs font-medium text-red-700 bg-red-50 rounded hover:bg-red-100 transition">
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-6 py-6 text-center text-gray-500">
                            No posts found.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Pagination --}}
    <div>
        {{ $posts->links() }}
    </div>

</div>
@endsection

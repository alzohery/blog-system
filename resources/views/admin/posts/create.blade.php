@extends('layouts.admin')

@section('content')
<div class="max-w-4xl mx-auto p-6 space-y-6">

    {{-- Header --}}
    <div>
        <h1 class="text-2xl font-semibold text-gray-800">Create New Post</h1>
        <p class="text-gray-500 text-sm">Fill the form below to create a new post.</p>
    </div>

    {{-- Success Message --}}
    @if(session('success'))
        <div class="p-4 bg-green-100 text-green-800 rounded">
            {{ session('success') }}
        </div>
    @endif

    {{-- Error Message --}}
    @if($errors->any())
        <div class="p-4 bg-red-100 text-red-800 rounded">
            {{ $errors->first() }}
        </div>
    @endif

    {{-- Form --}}
    <form method="POST"
          action="{{ route('admin.posts.store') }}"
          enctype="multipart/form-data"
          class="bg-white p-6 rounded shadow space-y-6">
        @csrf

        {{-- Title --}}
        <div>
            <label class="block text-sm font-medium text-gray-700">Title</label>
            <input type="text"
                   name="title"
                   value="{{ old('title') }}"
                   class="mt-1 w-full border rounded px-3 py-2 focus:outline-none focus:ring focus:ring-blue-200">
        </div>

        {{-- Slug --}}
        <div>
            <label class="block text-sm font-medium text-gray-700">
                Slug <span class="text-gray-400">(optional)</span>
            </label>
            <input type="text"
                   name="slug"
                   value="{{ old('slug') }}"
                   class="mt-1 w-full border rounded px-3 py-2">
        </div>

        {{-- Main Image --}}
        <div>
            <label class="block text-sm font-medium text-gray-700">Main Image</label>
            <input type="file"
                   name="main_image"
                   class="mt-1 block w-full text-sm">
        </div>

        {{-- Category --}}
        <div>
            <label class="block text-sm font-medium text-gray-700">Category</label>
            <select name="category_id"
                    class="mt-1 w-full border rounded px-3 py-2">
                <option value="">-- Select Category --</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}"
                        @selected(old('category_id') == $category->id)>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Content --}}
        <div>
            <label class="block text-sm font-medium text-gray-700">Content</label>
            <textarea id="content-editor"
                      name="content"
                      class="mt-1 w-full border rounded px-3 py-2"
                      rows="6">{{ old('content') }}</textarea>
        </div>

        {{-- Status --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700">Status</label>
                <select name="status"
                        class="mt-1 w-full border rounded px-3 py-2">
                    <option value="draft" @selected(old('status') === 'draft')>Draft</option>
                    <option value="published" @selected(old('status') === 'published')>Published</option>
                    <option value="scheduled" @selected(old('status') === 'scheduled')>Scheduled</option>
                </select>
            </div>

            {{-- Publish At --}}
            <div>
                <label class="block text-sm font-medium text-gray-700">
                    Publish At
                    <span class="text-gray-400 text-xs">(for scheduled posts)</span>
                </label>
                <input type="datetime-local"
                       name="publish_at"
                       value="{{ old('publish_at') }}"
                       class="mt-1 w-full border rounded px-3 py-2">
            </div>
        </div>

        {{-- Actions --}}
        <div class="flex items-center gap-3">
            <button type="submit"
                    class="px-6 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                Create Post
            </button>

            <a href="{{ route('admin.posts.index') }}"
               class="text-gray-600 hover:underline">
                Cancel
            </a>
        </div>
    </form>

</div>

{{-- CKEditor --}}
<script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>
<script>
    ClassicEditor
        .create(document.querySelector('#content-editor'))
        .catch(error => {
            console.error(error);
        });
</script>
@endsection

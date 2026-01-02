@extends('layouts.admin')

@section('content')
    <h1>Edit Category</h1>

    @if($errors->any())
        <p style="color: red;">{{ $errors->first() }}</p>
    @endif

    <form method="POST"
          action="{{ route('admin.categories.update', $category) }}">
        @csrf
        @method('PUT')

        <label>Name</label><br>
        <input type="text" name="name"
               value="{{ old('name', $category->name) }}"><br><br>

        <label>Slug</label><br>
        <input type="text" name="slug"
               value="{{ old('slug', $category->slug) }}"><br><br>

        <label>
            <input type="checkbox" name="is_active" value="1"
                {{ $category->is_active ? 'checked' : '' }}>
            Active
        </label><br><br>

        <button type="submit">Update</button>
    </form>
@endsection

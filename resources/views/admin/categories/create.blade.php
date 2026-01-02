@extends('layouts.admin')

@section('content')
    <h1>Create Category</h1>

    @if($errors->any())
        <p style="color: red;">{{ $errors->first() }}</p>
    @endif

    <form method="POST" action="{{ route('admin.categories.store') }}">
        @csrf

        <label>Name</label><br>
        <input type="text" name="name" value="{{ old('name') }}"><br><br>

        <label>Slug (optional)</label><br>
        <input type="text" name="slug" value="{{ old('slug') }}"><br><br>

        <label>
            <input type="checkbox" name="is_active" value="1" checked>
            Active
        </label><br><br>

        <button type="submit">Save</button>
    </form>
@endsection

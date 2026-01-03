@extends('layouts.admin')

@section('content')
<div class="max-w-7xl mx-auto p-6 space-y-6">

    {{-- Header --}}
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-semibold text-gray-800">Users</h1>
            <p class="text-gray-500 text-sm">Manage system users</p>
        </div>

        <a href="{{ route('admin.users.create') }}"
           class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
            + Create User
        </a>
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

    {{-- Table --}}
    <div class="overflow-hidden bg-white rounded-xl shadow ring-1 ring-gray-200">
        <table class="min-w-full text-sm">
            <thead class="bg-gray-50 border-b">
                <tr>
                    <th class="px-6 py-3 text-left font-semibold text-gray-600">Name</th>
                    <th class="px-6 py-3 text-left font-semibold text-gray-600">Email</th>
                    <th class="px-6 py-3 text-left font-semibold text-gray-600">Status</th>
                    <th class="px-6 py-3 text-left font-semibold text-gray-600">Created At</th>
                    <th class="px-6 py-3 text-right font-semibold text-gray-600">Actions</th>
                </tr>
            </thead>

            <tbody class="divide-y">
                @forelse($users as $user)
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-6 py-4 font-medium text-gray-800">{{ $user->name }}</td>
                        <td class="px-6 py-4 text-gray-500">{{ $user->email }}</td>
                        <td class="px-6 py-4">
                            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium
                                {{ $user->is_active
                                    ? 'bg-green-100 text-green-700'
                                    : 'bg-gray-100 text-gray-600' }}">
                                {{ $user->is_active ? 'Active' : 'Inactive' }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-gray-500">{{ $user->created_at }}</td>

                        <td class="px-6 py-4 text-right whitespace-nowrap">
                            <a href="{{ route('admin.users.edit', $user) }}"
                               class="inline-flex items-center px-3 py-1.5 text-xs font-medium
                                      text-blue-700 bg-blue-50 rounded hover:bg-blue-100">
                                Edit
                            </a>

                            <form action="{{ route('admin.users.destroy', $user) }}"
                                  method="POST"
                                  class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        onclick="return confirm('Are you sure?')"
                                        class="inline-flex items-center px-3 py-1.5 text-xs font-medium
                                               text-red-700 bg-red-50 rounded hover:bg-red-100 ml-2">
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-6 py-6 text-center text-gray-500">
                            No users found.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Pagination --}}
    @if(method_exists($users, 'links'))
        <div class="mt-4">
            {{ $users->links() }}
        </div>
    @endif

</div>
@endsection

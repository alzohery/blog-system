@extends('layouts.admin')

@section('content')
<div class="max-w-7xl mx-auto p-6 space-y-6">

    {{-- Header --}}
    <div>
        <h1 class="text-2xl font-semibold text-gray-800">Activity Logs</h1>
        <p class="text-gray-500 text-sm">Track admin actions across the system.</p>
    </div>

    {{-- Table --}}
    <div class="overflow-hidden bg-white rounded-xl shadow ring-1 ring-gray-200">
        <table class="min-w-full text-sm">
            <thead class="bg-gray-50 border-b">
                <tr>
                    <th class="px-6 py-3 text-left font-semibold text-gray-600">Admin</th>
                    <th class="px-6 py-3 text-left font-semibold text-gray-600">From</th>
                    <th class="px-6 py-3 text-left font-semibold text-gray-600">Action</th>
                    <th class="px-6 py-3 text-left font-semibold text-gray-600">Date</th>
                </tr>
            </thead>

            <tbody>
    @forelse($logs as $log)
        <tr class="hover:bg-gray-100 transition even:bg-gray-50">
            <td class="px-6 py-4 text-gray-800">{{ $log->admin->name ?? '-' }}</td>
            <td class="px-6 py-4 text-gray-500">{{ class_basename($log->loggable_type) }}</td>
            <td class="px-6 py-4 text-gray-500">{{ ucfirst($log->action) }}</td>
            <td class="px-6 py-4 text-gray-500">{{ $log->created_at }}</td>
        </tr>
    @empty
        <tr>
            <td colspan="4" class="px-6 py-6 text-center text-gray-500">
                No activity logs found.
            </td>
        </tr>
    @endforelse
</tbody>

        </table>
    </div>

    {{-- Pagination --}}
    @if(method_exists($logs, 'links'))
        <div class="mt-4">
            {{ $logs->links() }}
        </div>
    @endif

</div>
@endsection

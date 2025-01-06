@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="bg-white shadow-md rounded-lg">
        <div class="bg-gradient-to-r from-blue-500 to-purple-600 text-white rounded-t-lg px-6 py-4 flex justify-between items-center">
            <h2 class="text-lg font-bold flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 mr-2" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M20 6h-3.586L15 4H9L7.586 6H4a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h16a1 1 0 0 0 1-1V7a1 1 0 0 0-1-1zM12 17a5 5 0 1 1 0-10 5 5 0 0 1 0 10z" />
                </svg>
                Today's Lunch Entries
            </h2>
            <div class="text-sm">
                <span class="mr-4">Total Entries: <strong>{{ $totalEntriesToday }}</strong></span>
                <span class="mr-4">Pending: <strong class="text-yellow-500">{{ $totalPending }}</strong></span>
                <span class="mr-4">Rejected: <strong class="text-red-500">{{ $totalRejected }}</strong></span>
                <span>Approved: <strong class="text-green-500">{{ $totalApproved }}</strong></span>
            </div>
        </div>

        <div class="p-6">
            <div class="overflow-x-auto">
                <table class="min-w-full border-collapse border border-gray-200">
                    <thead>
                        <tr class="bg-gray-100 text-gray-700 text-left">
                            <th class="py-3 px-4 border-b">#</th>
                            <th class="py-3 px-4 border-b">Employee</th>
                            <th class="py-3 px-4 border-b">Date</th>
                            <th class="py-3 px-4 border-b">Status</th>
                            <th class="py-3 px-4 border-b">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($entries as $entry)
                        <tr class="hover:bg-gray-50">
                            <td class="py-3 px-4 border-b">{{ $loop->iteration }}</td>
                            <td class="py-3 px-4 border-b">{{ $entry->user->name }}</td>
                            <td class="py-3 px-4 border-b">{{ $entry->date }}</td>
                            <td class="py-3 px-4 border-b">
                                @if($entry->status === 'pending')
                                <span class="inline-flex items-center px-3 py-1 text-sm font-medium text-yellow-700 bg-yellow-100 rounded-full">
                                    Pending
                                </span>
                                @elseif($entry->status === 'approved')
                                <span class="inline-flex items-center px-3 py-1 text-sm font-medium text-green-700 bg-green-100 rounded-full">
                                    Approved
                                </span>
                                @else
                                <span class="inline-flex items-center px-3 py-1 text-sm font-medium text-red-700 bg-red-100 rounded-full">
                                    Rejected
                                </span>
                                @endif
                            </td>
                            <td class="py-3 px-4 border-b">
                                @if($entry->status === 'pending')
                                <div class="flex items-center space-x-2">
                                    <form action="{{ route('admin.lunch.approve', $entry) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="bg-green-500 text-white px-3 py-1 text-sm rounded hover:bg-green-600">
                                            Approve
                                        </button>
                                    </form>
                                    <form action="{{ route('admin.lunch.reject', $entry) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="bg-red-500 text-white px-3 py-1 text-sm rounded hover:bg-red-600">
                                            Reject
                                        </button>
                                    </form>
                                </div>
                                @else
                                <span class="text-gray-500">{{ ucfirst($entry->status) }}</span>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="py-4 text-center text-gray-500">No lunch entries available for today.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
@extends('layouts.app')

@section('content')
<div class="container mx-auto py-8">
    <div class="flex justify-center">
        <div class="w-full max-w-6xl">
            <div class="bg-white shadow-md rounded-lg overflow-hidden">
                <div class="bg-blue-600 text-white px-6 py-4">
                    <div class="flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 mr-2" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <line x1="9" y1="6" x2="20" y2="6" />
                            <line x1="9" y1="12" x2="20" y2="12" />
                            <line x1="9" y1="18" x2="20" y2="18" />
                            <line x1="5" y1="6" x2="5" y2="6.01" />
                            <line x1="5" y1="12" x2="5" y2="12.01" />
                            <line x1="5" y1="18" x2="5" y2="18.01" />
                        </svg>
                        <h2 class="text-lg font-semibold">Lunch Entries</h2>
                    </div>
                </div>

                <div class="p-6">
                    @if(session('success'))
                    <div class="bg-green-100 text-green-800 border border-green-200 rounded p-4 mb-4">
                        {{ session('success') }}
                    </div>
                    @endif

                    @if(session('error'))
                    <div class="bg-red-100 text-red-800 border border-red-200 rounded p-4 mb-4">
                        {{ session('error') }}
                    </div>
                    @endif

                    <form action="{{ route('lunch.store') }}" method="POST" class="mb-6">
                        @csrf
                        <div class="flex justify-end">
                            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded shadow">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 inline-block mr-1" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M4 3v18" />
                                    <path d="M9 3v18" />
                                    <path d="M15 3h3" />
                                    <path d="M15 12h3" />
                                    <path d="M18 3v18" />
                                </svg>
                                Mark Lunch for Today
                            </button>
                        </div>
                    </form>

                    <p class="text-lg font-semibold mb-4">Lunch History:</p>
                    <div class="overflow-x-auto">
                        <table class="min-w-full bg-white border border-gray-200">
                            <thead>
                                <tr class="bg-gray-100">
                                    <th class="px-6 py-3 border-b border-gray-200 text-left text-sm font-medium text-gray-600">SL</th>
                                    <th class="px-6 py-3 border-b border-gray-200 text-left text-sm font-medium text-gray-600">Date</th>
                                    <th class="px-6 py-3 border-b border-gray-200 text-left text-sm font-medium text-gray-600">Status</th>
                                    <th class="px-6 py-3 border-b border-gray-200 text-left text-sm font-medium text-gray-600">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($entries as $entry)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4 border-b border-gray-200 text-sm">{{ $loop->iteration  }}</td>
                                    <td class="px-6 py-4 border-b border-gray-200 text-sm">{{ $entry->date }}</td>
                                    <td class="px-6 py-4 border-b border-gray-200 text-sm">
                                        @if($entry->status === 'approved')
                                        <span class="bg-green-100 text-green-800 px-3 py-1 rounded-full text-xs font-medium">Approved</span>
                                        @elseif($entry->status === 'pending')
                                        <span class="bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-xs font-medium">Pending</span>
                                        @else
                                        <span class="bg-red-100 text-red-800 px-3 py-1 rounded-full text-xs font-medium">Rejected</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 border-b border-gray-200 text-sm">
                                        @if(auth()->user()->is_admin && $entry->status === 'pending')
                                        <a href="{{ route('lunch.approve', $entry->id) }}" class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded text-xs font-medium">Approve</a>
                                        <a href="{{ route('lunch.reject', $entry->id) }}" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded text-xs font-medium ml-2">Reject</a>
                                        @endif

                                        @if($entry->status === 'pending')
                                        <form action="{{ route('lunch.cancel', $entry) }}" method="POST" class="inline-block ml-2">
                                            @csrf
                                            <button type="submit" class="bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded text-xs font-medium">Cancel</button>
                                        </form>
                                        @endif
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="4" class="px-6 py-4 border-b border-gray-200 text-sm text-center text-gray-500">There are no lunch entries.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Today's Lunch Entries</h1>

    <table class="table">
        <thead>
            <tr>
                <th>Employee</th>
                <th>Date</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($entries as $entry)
            <tr>
                <td>{{ $entry->user->name }}</td>
                <td>{{ $entry->date }}</td>
                <td>{{ ucfirst($entry->status) }}</td>
                <td>
                    @if($entry->status === 'pending')
                    <form action="{{ route('admin.lunch.approve', $entry) }}" method="POST" style="display:inline;">
                        @csrf
                        <button type="submit" class="btn btn-success">Approve</button>
                    </form>
                    <form action="{{ route('admin.lunch.reject', $entry) }}" method="POST" style="display:inline;">
                        @csrf
                        <button type="submit" class="btn btn-danger">Reject</button>
                    </form>
                    @else
                    {{ ucfirst($entry->status) }}
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
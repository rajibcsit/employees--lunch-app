@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <i class="fa fa-utensils"></i> Today's Lunch Entries
                    <span class="float-end">
                        <i class="fa fa-hashtag"></i> Total Entries: {{ $totalEntriesToday }} |
                        <i class="fa fa-clock"></i> Pending: {{ $totalPending }} |
                        <i class="fa fa-times"></i> Rejected: {{ $totalRejected }} |
                        <i class="fa fa-check"></i> Approved: {{ $totalApproved }}
                    </span>
                </div>
                <div class="card-body">
                    <table class="table table-bordered data-table">
                        <thead class="thead-dark">
                            <tr>
                                <th width="70px">#</th>
                                <th>Employee</th>
                                <th>Date</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($entries as $entry)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $entry->user->name }}</td>
                                <td>{{ $entry->date }}</td>
                                <td>
                                    @if($entry->status === 'pending')
                                    <span class="badge bg-warning"><i class="fa fa-clock"></i> Pending</span>
                                    @elseif($entry->status === 'approved')
                                    <span class="badge bg-success"><i class="fa fa-check"></i> Approved</span>
                                    @else
                                    <span class="badge bg-danger"><i class="fa fa-times"></i> Rejected</span>
                                    @endif
                                </td>
                                <td>
                                    @if($entry->status === 'pending')
                                    <form action="{{ route('admin.lunch.approve', $entry) }}" method="POST" style="display:inline;">
                                        @csrf
                                        <button type="submit" class="btn btn-success btn-sm">
                                            <i class="fa fa-check"></i> Approve
                                        </button>
                                    </form>
                                    <form action="{{ route('admin.lunch.reject', $entry) }}" method="POST" style="display:inline;">
                                        @csrf
                                        <button type="submit" class="btn btn-danger btn-sm">
                                            <i class="fa fa-times"></i> Reject
                                        </button>
                                    </form>
                                    @else
                                    {{ ucfirst($entry->status) }}
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="text-center">No lunch entries available for today.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <i class="fa fa-list"></i> {{ __('Lunch Entries') }}
                </div>

                <div class="card-body">
                    @if(session('success'))
                    <div class="alert alert-success" role="alert">
                        {{ session('success') }}
                    </div>
                    @endif

                    <form action="{{ route('lunch.store') }}" method="POST" class="mb-4">
                        @csrf
                        <div class="text-end">
                            <button type="submit" class="btn btn-primary"><i class="fa fa-utensils"></i> Mark Lunch for Today</button>
                        </div>
                    </form>

                    <p><strong>Lunch History:</strong></p>
                    <table class="table table-bordered data-table">
                        <thead>
                            <tr>
                                <th width="70px">ID</th>
                                <th>Date</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($entries as $entry)
                            <tr>
                                <td>{{ $entry->id }}</td>
                                <td>{{ $entry->date }}</td>
                                <td>
                                    @if($entry->status === 'approved')
                                    <span class="badge bg-success"><i class="fa fa-check"></i> Approved</span>
                                    @elseif($entry->status === 'pending')
                                    <span class="badge bg-primary"><i class="fa fa-circle-dot"></i> Pending</span>
                                    @else
                                    <span class="badge bg-danger"><i class="fa fa-times"></i> Rejected</span>
                                    @endif
                                </td>
                                @if(auth()->user()->is_admin)
                                <td>
                                    @if($entry->status === 'pending')
                                    <a href="{{ route('lunch.approve', $entry->id) }}" class="btn btn-success btn-sm"><i class="fa fa-save"></i> Approve</a>
                                    <a href="{{ route('lunch.reject', $entry->id) }}" class="btn btn-danger btn-sm"><i class="fa fa-times"></i> Reject</a>
                                    @endif
                                </td>
                                @endif
                                <td>
                                    @if($entry->status === 'pending')
                                    <form action="{{ route('lunch.cancel', $entry) }}" method="POST" style="display:inline;">
                                        @csrf
                                        <button type="submit" class="btn btn-warning btn-sm">
                                            <i class="fa fa-times"></i> Cancel
                                        </button>
                                    </form>
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4">There are no lunch entries.</td>
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
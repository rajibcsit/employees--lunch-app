<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\LunchEntry;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LunchEntryController extends Controller
{
    // Employee: View and manage lunch entries
    public function index()
    {
        $user = Auth::user();
        $entries = LunchEntry::where('user_id', $user->id)
            ->orderBy('date', 'desc')
            ->get();

        return view('lunch.index', compact('entries'));
    }

    // Employee Store lunch entry
    public function store(Request $request)
    {
        $user = Auth::user();
        $today = Carbon::today()->toDateString();

        // Prevent duplicate entries for the same day
        if (LunchEntry::where('user_id', $user->id)->where('date', $today)->exists()) {
            return redirect()->back()->with('error', 'You have already marked lunch for today.');
        }

        LunchEntry::create([
            'user_id' => $user->id,
            'date' => $today,
            'status' => 'pending',
        ]);

        return redirect()->back()->with('success', 'Lunch entry submitted successfully.');
    }

    // Employee Cancle lunch entry
    public function cancel(LunchEntry $entry)
    {
        $user = Auth::user();

        if ($entry->user_id !== $user->id) {
            return redirect()->back()->with('error', 'Unauthorized action.');
        }

        if ($entry->status !== 'pending') {
            return redirect()->back()->with('error', 'Only pending entries can be canceled.');
        }

        $entry->delete();

        return redirect()->back()->with('success', 'Lunch entry canceled successfully.');
    }


    // Admin View all lunch entries for today
    public function adminIndex()
    {
        $entries = LunchEntry::with('user')
            ->where('date', Carbon::today()->toDateString())
            ->get();

        $totalEntriesToday = $entries->count();
        $totalPending = $entries->where('status', 'pending')->count();
        $totalRejected = $entries->where('status', 'rejected')->count();
        $totalApproved = $entries->where('status', 'approved')->count();

        return view('admin.lunch.index', compact('entries', 'totalEntriesToday', 'totalPending', 'totalRejected', 'totalApproved'));
    }

    // Admin Approve a lunch entry
    public function approve(LunchEntry $entry)
    {
        $entry->update(['status' => 'approved']);
        return redirect()->back()->with('success', 'Lunch entry approved.');
    }

    // Admin Reject a lunch entry
    public function reject(LunchEntry $entry)
    {
        $entry->update(['status' => 'rejected']);
        return redirect()->back()->with('success', 'Lunch entry rejected.');
    }
}

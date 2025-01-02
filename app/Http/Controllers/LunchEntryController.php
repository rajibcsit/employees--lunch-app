<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LunchEntry;
use Carbon\Carbon;

class LunchEntryController extends Controller
{
    // Employee: View and manage lunch entries
    public function index()
    {
        $user = auth()->user();
        $entries = LunchEntry::where('user_id', $user->id)
            ->orderBy('date', 'desc')
            ->get();

        return view('lunch.index', compact('entries'));
    }

    // Employee: Store lunch entry
    public function store(Request $request)
    {
        $user = auth()->user();
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

    // Admin: View all lunch entries for today
    public function adminIndex()
    {
        $entries = LunchEntry::with('user')
            ->where('date', Carbon::today()->toDateString())
            ->get();

        return view('admin.lunch.index', compact('entries'));
    }

    // Admin: Approve a lunch entry
    public function approve(LunchEntry $entry)
    {
        $entry->update(['status' => 'approved']);
        return redirect()->back()->with('success', 'Lunch entry approved.');
    }

    // Admin: Reject a lunch entry
    public function reject(LunchEntry $entry)
    {
        $entry->update(['status' => 'rejected']);
        return redirect()->back()->with('success', 'Lunch entry rejected.');
    }
}

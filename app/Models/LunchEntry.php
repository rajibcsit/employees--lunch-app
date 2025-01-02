<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class LunchEntry extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'date',
        'status',
    ];

    // Relationship with User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Scope to get entries for today
    public function scopeToday($query)
    {
        return $query->where('date', now()->toDateString());
    }

    // Scope to get pending entries
    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    // Approve entry
    public function approve()
    {
        $this->update(['status' => 'approved']);
    }

    // Reject entry
    public function reject()
    {
        $this->update(['status' => 'rejected']);
    }
}

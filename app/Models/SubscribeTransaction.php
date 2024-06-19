<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SubscribeTransaction extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'total_amount',
        'is_paid',
        'user_id',
        'proof',
        'subscription_start_date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

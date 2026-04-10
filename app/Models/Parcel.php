<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Parcel extends Model
{
    protected $fillable = [
        'tracking_number',
        'sender_name',
        'recipient_name',
        'address',
        'return_address',
        'status',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

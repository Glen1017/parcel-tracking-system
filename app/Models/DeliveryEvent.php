<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DeliveryEvent extends Model
{
    protected $fillable = [
        'parcel_id',
        'status',
        'user_id',
    ];

    public function parcel()
    {
        return $this->belongsTo(Parcel::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

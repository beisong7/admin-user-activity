<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Otp extends Model
{
    protected $fillable = [

        'uid',
        'sender_id',
        'otp',
        'expires_at',
        'verified_at',
        'sent_at',
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AccessKey extends Model
{
    protected $fillable = [
        'api_id',
        'name',
        'password',
        'method',
        'access_url',
        'port',
        'data_limit',
        'expires_at'
    ];

    protected $casts = [
        'expires_at' => 'datetime',
    ];
}

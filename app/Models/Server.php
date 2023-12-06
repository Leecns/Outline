<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Server extends Model
{
    protected $fillable = [
        'api_id',
        'name',
        'version',
        'hostname_for_new_access_keys',
        'port_for_new_access_keys',
        'metrics_status',
        'api_created_at'
    ];

    protected $casts = [
        'api_created_at' => 'datetime'
    ];

    public function keys(): HasMany
    {
        return $this->hasMany(AccessKey::class);
    }
}

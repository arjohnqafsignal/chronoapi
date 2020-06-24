<?php

namespace App\Models\Logs;

use Illuminate\Database\Eloquent\Model;

use Grimzy\LaravelMysqlSpatial\Eloquent\SpatialTrait;

class Auth extends Model
{
    use SpatialTrait;

    protected $spatialFields = [
        'position'
    ];
    
    protected $fillable = [
        'user_id', 'ip_address', 'event', 'position'
    ];
}

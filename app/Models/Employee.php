<?php

namespace App\Models;

use Tymon\JWTAuth\Contracts\JWTSubject;
use Grimzy\LaravelMysqlSpatial\Eloquent\SpatialTrait;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Notifications\Notifiable;

class Employee extends Authenticatable implements JWTSubject
{
    use Notifiable, SpatialTrait;

    protected $fillable = [
        'user_id', 'first_name', 'last_name', 'employee_id','middle_name','photo','birthdate','gender','joined_at', 'email', 'password', 'username', 
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $spatialFields = [
        'location'
    ];

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }
}

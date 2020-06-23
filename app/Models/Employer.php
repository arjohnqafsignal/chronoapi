<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employer extends Model
{
    protected $fillable = [
        'user_id', 'company_name', 'website', 'address', 'phone', 'registration_number'
    ];
}

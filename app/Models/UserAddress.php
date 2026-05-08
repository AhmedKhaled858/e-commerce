<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class UserAddress extends Model
{
    //
    protected $fillable = [
        'user_id',
        'full_name',
        'phone_number',
        'address',
        'city',
        'state',
        'postal_code',
        'country',
    ];
}

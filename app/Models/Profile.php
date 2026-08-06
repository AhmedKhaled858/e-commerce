<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Profile extends Model
{
    //
    use HasFactory;
    protected $primaryKey = 'user_id';
    protected $fillable = [
        'user_id',
        'first_name',
        'last_name',
        'phone_number',
        'street_address',
        'city',
        'state',
        'birth_date',
        'postal_code',
        'country',
        'locale',
        'image',
    ];
    public function user(){
        return $this->belongsTo(User::class);
    }
}

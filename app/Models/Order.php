<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\UserAddress;


class Order extends Model
{
    //
    protected $fillable = [
        'user_id',
        'order_number',
        'total_amount',
        'status',
        's_full_name',
        's_phone_number',
        's_address',
        's_city',
        'payment_method',

    ];
    public function items(){
        return $this->hasMany(OrderItem::class);
    }
}

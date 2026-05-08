<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\UserAddress;
use App\Models\OrderItem;
use App\Enums\OrderStatus;
use App\Enums\PaymentMethod;

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

    protected $casts = [
        'total_amount' => 'decimal:2',
        'status' => OrderStatus::class,
        'payment_method' => PaymentMethod::class,
    ];
    public function items(){
        return $this->hasMany(OrderItem::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
}

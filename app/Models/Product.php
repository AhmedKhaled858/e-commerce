<?php

namespace App\Models;

use App\Models\Scopes\StoreSCope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Override;

class Product extends Model
{
    //
    use HasFactory;
    protected $guarded = [];
   // this is the global scope calling to return only product for auth user (store_id)
    protected static function booted()
    {
        static::addGlobalScope(new StoreSCope);
    }
    //relation with category 1 t 1 
    public function category(){
        return $this->belongsTo(Category::class);
    }
    // relation with store 1 t 1
    public function store(){
        return $this->belongsTo(Store::class);
    }
    //relation with reviews 1 t m
    public function reviews(){
        return $this->hasMany(Review::class);
    }
}

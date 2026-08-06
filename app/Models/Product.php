<?php

namespace App\Models;

use App\Models\Scopes\StoreSCope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Override;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes;


class Product extends Model
{
    //
    use HasFactory,SoftDeletes;
    protected $guarded = [];
     public function scopeFilter(Builder $builder,$filters){
        $builder ->when($filters['search']??false, function ($query,$value) {
            $query->where('title', 'like', "%{$value}%");
        })
        ->when($filters['status']??false, function ($query,$value) {
            $query->where('status', $value);
        });
    }
   // this is the global scope calling to return only product for auth user (store_id)
    protected static function booted()
    {
        static::addGlobalScope(new StoreSCope);
    }
    public function tags(){
        return $this->belongsToMany(Tag::class,'product_tag');
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

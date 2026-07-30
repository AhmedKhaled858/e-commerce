<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Collection;
class Category extends Model
{
    //
    use HasFactory, SoftDeletes;
    protected $guarded = [];

    public function products(){
        return $this->hasMany(Product::class,'category_id','id');
    }

    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }
    public function availableParents()
    {
        return self::where('id', '<>', $this->id)
            ->where(function ($query) {
                $query->whereNull('parent_id')->orWhere('parent_id', '<>', $this->id);
            })
            ->get();
    }
    public function scopeFilter(Builder $builder,$filters){
        $builder ->when($filters['search']??false, function ($query,$value) {
            $query->where('name', 'like', "%{$value}%");
        })
        ->when($filters['status']??false, function ($query,$value) {
            $query->where('status', $value);
        });
    }
}

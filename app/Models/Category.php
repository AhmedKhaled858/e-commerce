<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Collection;
class Category extends Model
{
    //
    use HasFactory;
    protected $guarded = [];

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
}

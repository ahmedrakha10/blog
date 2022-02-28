<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    protected $table    = 'articles';
    protected $fillable = ['title', 'description', 'image', 'category_id'];
    protected $casts    = [
        'created_at' => 'date:m-d-Y',
        'updated_at' => 'date:m-d-Y',
    ];


    public function category()
    {
        return $this->belongsTo(Category::class);
    }


    public function scopeWhenCategoryId($query, $categoryId)
    {
        return $query->when($categoryId, function ($q) use ($categoryId) {
            return $q->whereHas('category', function ($q2) use ($categoryId) {
                return $q2->where('id', $categoryId);
            });

        });
    }
}

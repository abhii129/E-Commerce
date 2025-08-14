<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name',
        'description',
        'category_id',
        'subcategory_id',
        'image',
        'brand',
        'availability',
        'price',
        'attributes',      // ✅ add this

    ];

    protected $casts = [
        'availability' => 'integer',
        'price' => 'decimal:2',
        'attributes'   => 'array', // ← crucial

    ];

    // Relationships
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function subcategory()
    {
        return $this->belongsTo(Subcategory::class);
    }

    public function attributeValues()
    {
        return $this->hasMany(ProductAttributeValue::class);
    }
}

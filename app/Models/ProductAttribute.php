<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductAttribute extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id', 'subcategory_id', 'name', 'type', 'options',
    ];

    protected $casts = [
        'options' => 'array', // To store options as JSON if needed
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function subcategory()
    {
        return $this->belongsTo(Subcategory::class);
    }

    // app/Models/ProductAttribute.php

public function products()
{
    return $this->belongsToMany(Product::class, 'product_attribute')
                ->withPivot('value')
                ->withTimestamps();
}

}

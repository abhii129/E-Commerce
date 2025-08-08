<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
        protected $fillable = [
            'name', 'description', 'category_id', 'subcategory_id', 'image',
            'brand', 'fit_type', 'gender', 'availability', 'price'  // Add 'price' here
        ];
    
        // ...
    
    

    public function variations()
    {
        return $this->hasMany(ProductVariation::class);
    }
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function subcategory()
    {
        return $this->belongsTo(Subcategory::class);
    }
}

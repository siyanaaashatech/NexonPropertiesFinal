<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'category_id',
        'sub_category_id',
        'street',
        'suburb',
        'state',
        'post_code',
        'country',
        'price',
        'price_type',
        'bedrooms',
        'bathrooms',
        'area',
        'status',
        'main_image',
        'availability_status',
        'rental_period',
        'other_images',
        'metadata_id'
    ];

    protected $casts = [
        'other_images' => 'array', // Handle multi-image upload as an array
    ];

    // Relationships
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function subCategory()
    {
        return $this->belongsTo(SubCategory::class);
    }

    public function metadata()
    {
        return $this->belongsTo(Metadata::class);
    }
}

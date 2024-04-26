<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class productGallery extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'image',
        'is_featured'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}

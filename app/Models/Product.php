<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;


    protected $fillable = [
        'external_code',
        'name',
        'description',
        'price',
        'discount',
    ];

    protected $hidden = ['created_at','id','updated_at','additionalFields'];
    public function additionalFields()
    {
        return $this->hasMany(ProductAdditionalField::class);
    }

    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }
}

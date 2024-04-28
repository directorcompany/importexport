<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductAdditionalField extends Model
{
    use HasFactory;

    protected $fillable = ['key', 'value'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}

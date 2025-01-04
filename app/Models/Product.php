<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'detail','price','cat_id'
    ];

    public function category()
    {
        return $this->belongsTo(ProductCat::class, 'cat_id'); // Assuming 'cat_id' is the foreign key
    }


    
}

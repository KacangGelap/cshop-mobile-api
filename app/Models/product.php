<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class product extends Model
{
    use HasFactory;

    protected $table = 'product';
    
    protected $fillable = [
        'product',
        'description',
        'stock',
        'price',
        'image',
        'category_id'
    ];

    public function category(){
        return $this->belongsTo('App\Models\category');
    }
}

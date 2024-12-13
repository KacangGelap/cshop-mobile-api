<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class cart extends Model
{
    use HasFactory;

    protected $table = 'user_cart';

    protected $fillable = [
        'user_id',
        'product_id',
        'stock',
    ];

    public function user(){
        return $this->belongsTo('App\Models\User');
    }
    public function product(){
        return $this->belongsTo('App\Models\product');
    }

}

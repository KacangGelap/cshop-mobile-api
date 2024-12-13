<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class order extends Model
{
    use HasFactory;
    protected $table = 'order';

    protected $fillable = [
        'user_id',
        'product_id',
        'stock',
        'status'
    ];
    public function user(){
        return $this->belongTo('App\Models\User');
    }
    public function product(){
        return $this->belongTo('App\Models\product');
    }
}

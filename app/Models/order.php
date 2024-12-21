<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class order extends Model
{
    use HasFactory;
    protected $table = 'orders';

    protected $fillable = [
        'user_id',
        'product_id',
        'stock',
        'status', #enum('diproses','dikirim','diterima','dikembalikan')
        'total_price'
    ];
    public function user(){
        return $this->belongsTo('App\Models\User');
    }
    public function product(){
        return $this->belongsTo('App\Models\product');
    }
}

<?php

namespace App\Models;

use App\Models\Order;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OrderDetail extends Model
{
    use HasFactory;
    protected $fillable=[
        'order_id','customer_id','product_id','product_name','qty','image','price'
    ];
    
    public function orders(){
        return $this->belongsTo(Order::class,'order_id','id');
    }
}

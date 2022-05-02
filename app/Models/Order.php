<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable=[
        'customer_id','customer_name','address','phone','payment_status',
        'partial_paid','partial_amount','due_amount','shop_name','total_amount',
        'invoice_number','order_number'
    ];
   
}

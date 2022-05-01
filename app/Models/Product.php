<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable=[
        'product_name','child_cat_id','supplier_id','product_code','warehouse',
        'product_route','image','purchase_date','expire_date','buying_price','selling_price',
        'status','CategoryName','stock',
    ];
    
    public function childCategory(){
        return $this->belongsTo(ChildCategory::class,'child_cat_id','id');
    }
}

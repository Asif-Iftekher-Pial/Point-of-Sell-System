<?php

namespace App\Exports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\FromCollection;

class ProductExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Product::select(
            'product_name','child_cat_id','supplier_id','product_code','warehouse',
        'product_route','image','purchase_date','expire_date','buying_price','selling_price',
        'status','CategoryName','stock'
        )->get();
    }
}

<?php

namespace App\Imports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\ToModel;

class ProductImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Product([
            'product_name' => $row[0],
            'child_cat_id' => $row[1],
            'supplier_id' => $row[2],
            'product_code' => $row[3],
            'warehouse' => $row[4],
            'product_route' => $row[5],
            'image' => $row[6],
            'purchase_date' => $row[7],
            'expire_date' => $row[8],
            'buying_price' => $row[9],
            'selling_price' => $row[10],
            'status' => $row[11],
            'CategoryName' => $row[12],
            'stock' => $row[13],
        ]);
       
    }
}

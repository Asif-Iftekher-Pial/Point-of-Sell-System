<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasFactory;
    protected $fillable=[
        'name',
        'status',
        'email',
        'phone',
        'address',
        'type',
        'image',
        'shop',
        'accountHolder',
        'accountNumber',
        'bankName',
        'branchName',
        'city',
    ];
    
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $fillable=[
        'name',
        'status',
        'email',
        'phone',
        'address',
        'experience',
        'image',
        'salary',
        'vacation',
        'city',
        
    ];
    
}

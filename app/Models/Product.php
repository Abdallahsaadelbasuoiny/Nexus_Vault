<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';

    // السماح بإدخال جميع الحقول دون الحاجة لتحديدها
    protected $guarded = [];


    protected $fillable = [
        'name',
        'price',
        'description',
        'status',
        'image',
    ];
}

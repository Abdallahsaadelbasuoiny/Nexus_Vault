<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DevicePassport extends Model
{
    use HasFactory;

    protected $guarded = [];

    // علاقة جواز السفر بالمنتج الرئيسي
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    // علاقة الجهاز بالمالك الحالي
    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }
}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResaleListing extends Model
{
    use HasFactory;

    protected $guarded = [];

    // علاقة الإعلان بجواز سفر الجهاز
    public function devicePassport()
    {
        return $this->belongsTo(DevicePassport::class);
    }

    // علاقة الإعلان بالبائع
    public function seller()
    {
        return $this->belongsTo(User::class, 'seller_id');
    }
}
<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class SystemUser extends Authenticatable
{
    use Notifiable;

    // اسم الجدول في قاعدة البيانات
    protected $table = 'system_users';

    // الحقول المسموح بتمريرها
    protected $fillable = [
        'loginName',
        'email',
        'password',
        'role',
    ];

    // إخفاء كلمة المرور عند الاستعلام
    protected $hidden = [
        'password',
        'remember_token',
    ];
}

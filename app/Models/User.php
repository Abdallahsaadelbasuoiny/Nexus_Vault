<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    // تحقق هل المستخدم أدمن
    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    // تحقق هل المستخدم موظف
    public function isEmployee(): bool
    {
        return $this->role === 'employee';
    }
}

<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\SystemUser;
use Symfony\Component\HttpFoundation\Response;

class AdminRole
{
    public function handle(Request $request, Closure $next): Response
    {
        // التحقق من صلاحية الأدمن عبر الجلسة ومعرف المستخدم
        if (Session::has('user_role') && Session::get('user_role') === 'adminRole') {
            $user = SystemUser::find(Session::get('user_id'));

            if ($user && $user->role === 'adminRole') {
                return $next($request);
            }
        }

        return redirect()->route('login')->with('failed', '!برجاء تسجيل الدخول أولاً');
    }
}
<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        // 1. إذا لم يكن مسجلاً للدخول أساساً -> تحويله لصفحة تسجيل الدخول
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'يجب تسجيل الدخول أولاً للوصول للوحة التحكم.');
        }

        $user = Auth::user();

        // 2. إذا كان أدمن -> السماح بالمرور للوحة التحكم
        if (in_array($user->role, ['admin', 'adminRole'])) {
            return $next($request);
        }

        // 3. إذا كان موظف -> تحويله لوحة الموظف
        if (in_array($user->role, ['employee', 'employeRole'])) {
            return redirect()->route('employe.index')->with('error', 'غير مسموح لك بدخول لوحة الأدمن.');
        }

        // 4. إذا كان مستخدم عادي -> تحويله لمعرض المنتجات
        return redirect()->route('user.products')->with('error', 'عفواً، لوحة التحكم خاصة بالإدارة فقط.');
    }
}

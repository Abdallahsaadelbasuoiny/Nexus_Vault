<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SystemUser;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class systemLogin extends Controller
{
    public function loginPage()
    {
        // إذا كان المستخدم مسجل دخوله بالفعل، وِجّهه مباشرة
        if (Auth::check()) {
            $user = Auth::user();
            if (in_array($user->role, ['admin', 'adminRole'])) {
                return redirect()->route('admin.products.index');
            }
            return redirect()->route('employe.index');
        }

        return view('systemLogin.loginPage');
    }

    public function checkLogin(Request $request)
    {
        $request->validate([
            'loginName' => 'required',
            'password'  => 'required',
        ]);

        $loginInput = $request->input('loginName');
        $password   = $request->input('password');

        // 1. الفحص في جدول system_users (الأدمن والموظفين)
        $systemUser = SystemUser::where('loginName', $loginInput)
            ->orWhere('email', $loginInput)
            ->first();

        if ($systemUser && Hash::check($password, $systemUser->password)) {
            Auth::login($systemUser);
            $request->session()->regenerate(); // حفظ الجلسة وتجديدها لتأكيد تسجيل الدخول

            session([
                'user_id'   => $systemUser->id,
                'user_role' => $systemUser->role,
                'user_name' => $systemUser->loginName,
            ]);

            if (in_array($systemUser->role, ['adminRole', 'admin'])) {
                return redirect()->route('admin.products.index');
            }

            return redirect()->route('employe.index');
        }

        // 2. الفحص في جدول users العادي
        $user = User::where('email', $loginInput)
            ->orWhere('name', $loginInput)
            ->first();

        if ($user && Hash::check($password, $user->password)) {
            Auth::login($user);
            $request->session()->regenerate(); // حفظ الجلسة وتجديدها لتأكيد تسجيل الدخول

            session([
                'user_id'    => $user->id,
                'user_role'  => $user->role ?? 'userRole',
                'user_name'  => $user->name,
                'user_email' => $user->email,
            ]);

            // الفحص بناءً على حقل role
            if (in_array($user->role, ['admin', 'adminRole'])) {
                return redirect()->route('admin.products.index');
            }

            if (in_array($user->role, ['employee', 'employeRole'])) {
                return redirect()->route('employe.index');
            }

            return redirect()->route('user.products');
        }

        return back()->withErrors(['msg' => 'اسم المستخدم أو كلمة المرور غير صحيحة'])->withInput();
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}

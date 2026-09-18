<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class SystemUserController extends Controller
{
    public function index()
    {
        $users = DB::table('system_users')->latest()->paginate(10);
        return view('admin.users.index', compact('users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'loginName' => 'required|string|max:255',
            'email'     => 'required|email',
            'password'  => 'required|min:6',
            'role'      => 'required|in:adminRole,employeRole',
        ]);

        DB::table('system_users')->insert([
            'loginName'  => $request->loginName,
            'email'      => $request->email,
            'password'   => Hash::make($request->password),
            'role'       => $request->role,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->back()->with('success', 'تمت إضافة المستخدم بنجاح!');
    }

    public function destroy($id)
    {
        DB::table('system_users')->where('id', $id)->delete();
        return redirect()->back()->with('success', 'تم حذف المستخدم بنجاح!');
    }
}
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\systemLogin;
use App\Http\Controllers\SystemUserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\EmployeController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// 1. الصفحة الرئيسية للزوار والمستخدمين
Route::get('/', [HomeController::class, 'index'])->name('home');

// 2. مسارات تسجيل الدخول (للضيوف فقط)
Route::middleware(['guest'])->group(function () {
    Route::get('signin', [systemLogin::class, 'loginPage'])->name('login');
    Route::get('login', [systemLogin::class, 'loginPage']);
    Route::post('checkLogin', [systemLogin::class, 'checkLogin'])->name('checkLogin');
});

// 3. تسجيل الخروج
Route::any('logout', [systemLogin::class, 'logout'])->name('logout');

// 4. مسارات المستخدم العادي (User)
Route::middleware(['auth'])->prefix('user')->name('user.')->group(function () {
    Route::get('/products', [AdminProductController::class, 'index'])->name('products');
});

// 5. مسارات الموظف (Employee)
Route::middleware(['auth', 'employee'])->prefix('employe')->name('employe.')->group(function () {
    Route::get('/', [EmployeController::class, 'index'])->name('index');
    Route::post('/products', [EmployeController::class, 'storeProduct'])->name('products.store');
});

// مسار مستعار للتوجيه المباشر للموظف
Route::get('/employee/dashboard', [EmployeController::class, 'index'])
    ->middleware(['auth', 'employee'])
    ->name('employee.dashboard');

// 6. لوحة تحكم الأدمن (Admin)
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {

    // الرئيسية للأدمن
    Route::get('/', [AdminController::class, 'index'])->name('dashboard');

    // إدارة مستخدمي النظام
    Route::resource('systemUsers', SystemUserController::class);

    // تغيير حالة المنتجات (موافقة / رفض)
    Route::patch('/products/{product}/approve', [AdminProductController::class, 'approve'])->name('products.approve');
    Route::patch('/products/{product}/reject', [AdminProductController::class, 'reject'])->name('products.reject');

    // إدارة المنتجات (CRUD)
    Route::resource('products', AdminProductController::class);
});

// مسار مستعار لـ route('admin') لمنع أخطاء التوجيه
Route::get('/admin-redirect', function () {
    return redirect()->route('admin.products.index');
})->middleware(['auth', 'admin'])->name('admin');
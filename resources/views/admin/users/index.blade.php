@extends('layouts.app')

@section('title', 'إدارة المستخدمين')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4 border-bottom pb-3">
        <div>
            <h2 class="fw-bold text-dark"><i class="bi bi-people-fill text-primary"></i> إدارة مستخدمي النظام</h2>
            <p class="text-muted m-0">إضافة مدراء وموظفين جدد للتحكم بالنظام</p>
        </div>
        <div>
            <a href="{{ route('admin') }}" class="btn btn-outline-secondary me-2">
                <i class="bi bi-arrow-right"></i> العودة للوحة الأدمن
            </a>
            <button class="btn btn-primary fw-bold" data-bs-toggle="modal" data-bs-target="#addUserModal">
                <i class="bi bi-person-plus-fill me-1"></i> إضافة مستخدم جديد
            </button>
        </div>
    </div>

    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show shadow-sm">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @endif

    <!-- جدول المستخدمين -->
    <div class="card shadow-sm border-0">
        <div class="card-header bg-dark text-white fw-bold py-3">
            <i class="bi bi-list-ul me-2"></i> قائمة كافة الحسابات المسجلة
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle text-center m-0">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>الاسم / Login Name</th>
                            <th>البريد الإلكتروني</th>
                            <th>الصلاحية (Role)</th>
                            <th>تاريخ الإنشاء</th>
                            <th>التحكم</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($users as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td class="fw-bold">{{ $user->loginName ?? $user->name }}</td>
                            <td>{{ $user->email ?? 'لا يوجد بريد' }}</td>
                            <td>
                                @if(($user->role ?? '') === 'adminRole')
                                <span class="badge bg-danger">مدير (Admin)</span>
                                @else
                                <span class="badge bg-info text-white">موظف (Employee)</span>
                                @endif
                            </td>
                            <td class="text-muted">
                                {{ $user->created_at ? \Carbon\Carbon::parse($user->created_at)->format('Y-m-d') : '-' }}
                            </td>
                            <td>
                                <form action="{{ route('systemUsers.destroy', $user->id) }}" method="POST" onsubmit="return confirm('هل أنت تأكيد من حذف هذا المستخدم؟')">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-sm btn-outline-danger">
                                        <i class="bi bi-trash"></i> حذف
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="py-4 text-muted">لا يوجد مستخدمون حالياً.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="mt-3">
        {{ $users->links() }}
    </div>
</div>

<!-- Modal إضافة مستخدم جديد -->
<div class="modal fade" id="addUserModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content text-start">
            <form action="{{ route('systemUsers.store') }}" method="POST">
                @csrf
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title fw-bold"><i class="bi bi-person-plus me-2"></i> إضافة حساب جديد</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label font-weight-bold">اسم الدخول (Login Name)</label>
                        <input type="text" name="loginName" class="form-control" placeholder="مثال: ahmed_dev" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">البريد الإلكتروني</label>
                        <input type="email" name="email" class="form-control" placeholder="user@system.com" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">كلمة المرور</label>
                        <input type="password" name="password" class="form-control" placeholder="******" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">نوع الصلاحية</label>
                        <select name="role" class="form-select" required>
                            <option value="employeRole">موظف (Employee)</option>
                            <option value="adminRole">مدير (Admin)</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إلغاء</button>
                    <button type="submit" class="btn btn-primary">حفظ المستخدم</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
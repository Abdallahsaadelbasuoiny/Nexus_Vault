@extends('layouts.app')

@section('title', 'قائمة المستخدمين')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>إدارة المستخدمين</h2>
        <a href="{{ route('admin') }}" class="btn btn-secondary btn-sm">العودة للوحة التحكم</a>
    </div>

    <div class="card shadow">
        <div class="card-body">
            <table class="table table-bordered table-striped text-center">
                <thead class="table-dark">
                    <tr>
                        <th>#</th>
                        <th>اسم المستخدم (Login Name)</th>
                        <th>الصلاحية (Role)</th>
                        <th>تاريخ الإنشاء</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($systemUsers as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->loginName }}</td>
                            <td>
                                <span class="badge {{ $user->role == 'adminRole' ? 'bg-danger' : 'bg-primary' }}">
                                    {{ $user->role }}
                                </span>
                            </td>
                            <td>{{ $user->created_at->format('Y-m-d') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4">لا يوجد مستخدمين حالياً.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            <!-- Pagination -->
            <div class="d-flex justify-content-center mt-3">
                {{ $systemUsers->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
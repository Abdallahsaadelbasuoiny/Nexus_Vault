@extends('layouts.app')

@section('content')
<div class="container py-4">

    <!-- شريط الإجراءات العلوي -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="text-primary fw-bold">لوحة التحكم الرئيسية (الأدمن)</h2>
            <p class="text-muted">إدارة كافة المنتجات والمستخدمين وصلاحيات العرض</p>
        </div>
        <div>
            <a href="{{ route('admin.products.create') }}" class="btn btn-success fw-bold px-3 me-2">
                <i class="bi bi-plus-lg me-1"></i> إضافة منتج جديد
            </a>
            <a href="#" class="btn btn-dark fw-bold px-3">إدارة المستخدمين</a>
        </div>
    </div>

    <!-- التنبيهات -->
    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <!-- جدول المنتجات -->
    <div class="card bg-dark text-white shadow border-0">
        <div class="card-header bg-secondary bg-opacity-20 d-flex justify-content-between align-items-center py-3">
            <h5 class="mb-0 fw-bold">قائمة كافة المنتجات</h5>
            <span class="badge bg-primary fs-6">{{ $products->total() ?? $products->count() }} منتج</span>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-dark table-hover align-middle mb-0 text-center">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>الصورة</th>
                            <th>المنتج</th>
                            <th>السعر</th>
                            <th>الوصف</th>
                            <th>الحالة</th>
                            <th>التحكم بالمنتج</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($products as $product)
                        <tr>
                            <td>{{ $loop->iteration }}</td>

                            <!-- صورة المنتج -->
                            <td>
                                @if($product->image)
                                <img src="{{ filter_var($product->image, FILTER_VALIDATE_URL) ? $product->image : asset('storage/' . $product->image) }}"
                                    class="rounded" style="width: 45px; height: 45px; object-fit: cover;">
                                @else
                                <span class="text-white-50 small">بدون صورة</span>
                                @endif
                            </td>

                            <td class="fw-bold text-white">{{ $product->title ?? $product->name ?? $product->device_name }}</td>
                            <td class="text-success fw-bold">${{ number_format($product->price ?? $product->asking_price ?? 0, 2) }}</td>

                            <!-- تعديل لون الوصف إلى أبيض فاتح واضحة بدلاً من text-muted -->
                            <td class="text-light small" style="max-width: 200px; color: #f8f9fa !important;">
                                {{ \Illuminate\Support\Str::limit($product->description ?? $product->seller_notes ?? '', 40) }}
                            </td>

                            <!-- شارة الحالة -->
                            <td>
                                @if($product->status == 'approved' || $product->status == 'active' || $product->status == 1)
                                <span class="badge bg-success">مفعل / معتمد</span>
                                @elseif($product->status == 'rejected')
                                <span class="badge bg-danger">مرفوض</span>
                                @else
                                <span class="badge bg-warning text-dark">بانتظار الموافقة</span>
                                @endif
                            </td>

                            <!-- أزرار الإجراءات -->
                            <td>
                                <div class="d-flex justify-content-center gap-1">
                                    <!-- موافقة -->
                                    <form action="{{ route('admin.products.approve', $product->id) }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="btn btn-sm btn-success" title="موافقة">موافقة</button>
                                    </form>

                                    <!-- رفض -->
                                    <form action="{{ route('admin.products.reject', $product->id) }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="btn btn-sm btn-outline-warning" title="رفض">رفض</button>
                                    </form>

                                    <!-- تعديل -->
                                    <a href="{{ route('admin.products.edit', $product->id) }}" class="btn btn-sm btn-outline-info" title="تعديل">تعديل</a>

                                    <!-- حذف -->
                                    <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" onsubmit="return confirm('هل أنت تأكد من حذف هذا المنتج؟')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" title="حذف">حذف</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center py-4 text-white-50">لا توجد منتجات مسجلة حالياً.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- الترقيم الصفحي (Pagination) -->
    @if(method_exists($products, 'links'))
    <div class="d-flex justify-content-center mt-4">
        {{ $products->links('pagination::bootstrap-5') }}
    </div>
    @endif
</div>
@endsection
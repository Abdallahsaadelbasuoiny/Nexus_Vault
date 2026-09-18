@extends('layouts.app')

@section('title', 'لوحة الموظف')

@section('content')
<div class="container py-4">
    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4 pb-3 border-bottom">
        <div>
            <h2 class="fw-bold text-info mb-1"><i class="bi bi-person-workspace"></i> لوحة الموظف</h2>
            <p class="text-muted m-0">إضافة المنتجات ومتابعة حالة اعتمادها من قبل المدير</p>
        </div>
        <!-- زر فتح نافذة إضافة منتج -->
        <button class="btn btn-info text-white btn-lg shadow-sm" data-bs-toggle="modal" data-bs-target="#addProductModal">
            <i class="bi bi-plus-circle me-1"></i> إضافة منتج جديد
        </button>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show shadow-sm">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <!-- جدول منتجات الموظف -->
    <div class="card shadow-sm border-0">
        <div class="card-header bg-dark text-white fw-bold py-3">
            <i class="bi bi-list-task me-2"></i> المنتجات التي قمت بإضافتها
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle text-center m-0">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>اسم المنتج</th>
                            <th>السعر</th>
                            <th>الوصف</th>
                            <th>حالة الموافقة</th>
                            <th>تاريخ الإضافة</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($products as $product)
                            <tr>
                                <td>{{ $product->id }}</td>
                                <td class="fw-bold">{{ $product->name }}</td>
                                <td class="text-success fw-bold">${{ number_format($product->price, 2) }}</td>
                                <td>{{ Str::limit($product->description, 40) ?? 'لا يوجد' }}</td>
                                <td>
                                    @if($product->is_approved)
                                        <span class="badge bg-success"><i class="bi bi-check-circle"></i> تم القبول والعرض</span>
                                    @else
                                        <span class="badge bg-warning text-dark"><i class="bi bi-hourglass-split"></i> قيد المراجعة</span>
                                    @endif
                                </td>
                                <td class="text-muted">{{ $product->created_at->format('Y-m-d') }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="py-4 text-muted">لم تقم بتقديم أي منتجات حتى الآن.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modal إضافة منتج جديد -->
<div class="modal fade" id="addProductModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('employe.products.store') }}" method="POST">
                @csrf
                <div class="modal-header bg-info text-white">
                    <h5 class="modal-title fw-bold"><i class="bi bi-plus-square me-2"></i> إضافة منتج جديد</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label font-weight-bold">اسم المنتج</label>
                        <input type="text" name="name" class="form-control" placeholder="أدخل اسم المنتج" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">السعر ($)</label>
                        <input type="number" step="0.01" name="price" class="form-control" placeholder="0.00" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">الوصف التفصيلي</label>
                        <textarea name="description" class="form-control" rows="3" placeholder="أضف وصفاً شاملاً..."></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إلغاء</button>
                    <button type="submit" class="btn btn-info text-white">إرسال للمراجعة</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
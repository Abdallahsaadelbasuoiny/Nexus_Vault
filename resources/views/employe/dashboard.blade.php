@extends('layouts.app')

@section('content')
<div class="container py-4">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="text-success fw-bold">لوحة تحكم الموظف</h2>
            <p class="text-muted">متابعة وعرض المنتجات المتاحة في النظام</p>
        </div>
        @if(auth()->user()->isAdmin())
            <a href="{{ route('admin.products.index') }}" class="btn btn-primary fw-bold">
                الانتقال للوحة الأدمن
            </a>
        @endif
    </div>

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show mb-4">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="card bg-dark text-white shadow border-0">
        <div class="card-header bg-secondary bg-opacity-20 d-flex justify-content-between align-items-center py-3">
            <h5 class="mb-0 fw-bold">قائمة المنتجات (معاينة)</h5>
            <span class="badge bg-info fs-6">{{ $products->total() ?? $products->count() }} منتج</span>
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
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($products as $product)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
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
                            <td class="text-light small" style="max-width: 250px;">
                                {{ \Illuminate\Support\Str::limit($product->description ?? $product->seller_notes ?? '', 50) }}
                            </td>
                            <td>
                                @if($product->status == 'approved' || $product->status == 'active' || $product->status == 1)
                                    <span class="badge bg-success">مفعل / معتمد</span>
                                @elseif($product->status == 'rejected')
                                    <span class="badge bg-danger">مرفوض</span>
                                @else
                                    <span class="badge bg-warning text-dark">بانتظار الموافقة</span>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center py-4 text-white-50">لا توجد منتجات مسجلة حالياً.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    @if(method_exists($products, 'links'))
        <div class="d-flex justify-content-center mt-4">
            {{ $products->links('pagination::bootstrap-5') }}
        </div>
    @endif
</div>
@endsection
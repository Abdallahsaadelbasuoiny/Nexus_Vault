@extends('layouts.app')

@section('title', 'المعرض الإلكتروني والخزنة الرقمية')

@section('content')
<div class="container py-4" dir="rtl">

    {{-- 1. رأس الصفحة والترحيب --}}
    <div class="row mb-4 align-items-center bg-dark text-white p-4 rounded-3 shadow-sm">
        <div class="col-md-8">
            <h2 class="fw-bold mb-1"><i class="bi bi-laptop me-2"></i> معرض الأجهزة والمنتجات الإلكترونية</h2>
            <p class="text-muted mb-0">استعرض أحدث الأجهزة الذكية، الملحقات المعتمدة، وإدارة ضمانك الرقمي بكل سهولة.</p>
        </div>
        <div class="col-md-4 text-md-end mt-3 mt-md-0">
            <span class="badge bg-primary p-2 fs-6">مرحباً بك في المعرض</span>
        </div>
    </div>

    {{-- 2. شريط البحث والتصفية --}}
    <div class="row mb-4">
        <div class="col-md-8 mb-2 mb-md-0">
            <div class="input-group input-group-lg shadow-sm">
                <span class="input-group-text bg-white"><i class="bi bi-search"></i></span>
                <input type="text" id="searchInput" class="form-control border-start-0" placeholder="ابحث عن جهاز، موديل، أو مواصفات...">
            </div>
        </div>
        <div class="col-md-4">
            <select id="categoryFilter" class="form-select form-select-lg shadow-sm">
                <option value="all">جميع الفئات</option>
                <option value="laptops">أجهزة لاب توب (Laptops)</option>
                <option value="phones">هواتف ذكية (Smartphones)</option>
                <option value="monitors">شاشات وأجهزة عرض</option>
                <option value="accessories">إكسسوارات وملحقات</option>
            </select>
        </div>
    </div>

    <div class="row">
        {{-- 3. شبكة المنتجات الديناميكية (Main Product Grid) --}}
        <div class="col-lg-9">
            <div class="row g-4" id="productList">

                @forelse($products as $product)
                <div class="col-md-6 col-xl-4 product-card" data-category="{{ $product->category ?? 'accessories' }}">
                    <div class="card h-100 shadow-sm border-0 position-relative">

                        {{-- عرض الصورة مع استخدام المجلد الخارجي والمُعالج بحالة العدم --}}
                        @if($product->image)
                        <img src="{{ asset('storage/' . $product->image) }}" class="card-img-top p-3 rounded" style="height: 200px; object-fit: contain;" alt="{{ $product->name }}">
                        @else
                        <img src="https://via.placeholder.com/300x200?text=No+Image" class="card-img-top p-3 rounded" style="height: 200px; object-fit: contain;" alt="لا توجد صورة">
                        @endif

                        <div class="card-body d-flex flex-column">
                            <small class="text-primary fw-bold">{{ $product->category_name ?? 'إلكترونيات' }}</small>
                            <h5 class="card-title fw-bold">{{ $product->name }}</h5>
                            <p class="card-text text-muted small">{{ Str::limit($product->description ?? 'لا يوجد وصف متوفر للمنتج حالياً.', 80) }}</p>

                            <div class="mt-auto">
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <span class="fs-5 fw-bold text-dark">{{ number_format($product->price, 2) }} ج.م</span>
                                    <span class="badge bg-light text-dark border"><i class="bi bi-shield-check text-success"></i> موثق</span>
                                </div>
                                <button class="btn btn-primary w-100"><i class="bi bi-cart-plus me-1"></i> إضافة إلى الخزنة / شراء</button>
                            </div>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-12 text-center py-5">
                    <i class="bi bi-inbox display-1 text-muted"></i>
                    <p class="mt-3 text-muted fs-5">لا توجد منتجات مسجلة في المعرض حالياً.</p>
                </div>
                @endforelse

            </div>
        </div>

        {{-- 4. الشريط الجانبي (User Vault & Summary Sidebar) --}}
        <div class="col-lg-3 mt-4 mt-lg-0">
            <div class="card shadow-sm border-0 mb-4 bg-light">
                <div class="card-body">
                    <h5 class="card-title fw-bold border-bottom pb-2 mb-3"><i class="bi bi-safe text-primary"></i> الخزنة الرقمية للعميل</h5>
                    <p class="small text-muted">ملخص الأجهزة الإلكترونية والضمانات المسجلة بحسابك:</p>

                    <ul class="list-group list-group-flush rounded border mb-3">
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            الأجهزة المسجلة
                            <span class="badge bg-primary rounded-pill">3</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            الضمانات النشطة
                            <span class="badge bg-success rounded-pill">2</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            طلبات الصيانة
                            <span class="badge bg-warning text-dark rounded-pill">0</span>
                        </li>
                    </ul>

                    <button class="btn btn-outline-primary w-100 btn-sm"><i class="bi bi-shield-lock me-1"></i> عرض جواز سفر الأجهزة</button>
                </div>
            </div>

            <div class="card shadow-sm border-0 bg-primary text-white">
                <div class="card-body">
                    <h6 class="fw-bold"><i class="bi bi-headset me-1"></i> هل تحتاج لمساعدة أو صيانة؟</h6>
                    <p class="small opacity-75 mb-2">يمكنك تقديم طلب فحص أو نقل ملكية جهاز إلكتروني بسهولة عبر خدمة العميل.</p>
                    <a href="#" class="btn btn-light btn-sm w-100 text-primary fw-bold">تواصل مع الدعم الفني</a>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Script للتصفية والبحث الفوري --}}
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const searchInput = document.getElementById("searchInput");
        const categoryFilter = document.getElementById("categoryFilter");
        const cards = document.querySelectorAll(".product-card");

        function filterProducts() {
            const query = searchInput.value.toLowerCase();
            const category = categoryFilter.value;

            cards.forEach(card => {
                const title = card.querySelector(".card-title").innerText.toLowerCase();
                const text = card.querySelector(".card-text").innerText.toLowerCase();
                const cardCat = card.getAttribute("data-category");

                const matchesSearch = title.includes(query) || text.includes(query);
                const matchesCategory = category === "all" || cardCat === category;

                if (matchesSearch && matchesCategory) {
                    card.style.display = "block";
                } else {
                    card.style.display = "none";
                }
            });
        }

        searchInput.addEventListener("keyup", filterProducts);
        categoryFilter.addEventListener("change", filterProducts);
    });
</script>
@endsection
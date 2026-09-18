<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>NEXUS | المنصة التفاعلية للضمان وسوق المستعمل</title>

    <!-- Google Fonts (Cairo) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;600;700;800;900&display=swap" rel="stylesheet">

    <!-- Bootstrap 5 RTL & Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.rtl.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- AOS Animation Library -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <style>
        :root {
            --bg-dark: #090d16;
            --card-bg: rgba(30, 41, 59, 0.4);
            --modal-bg: #0f172a;
            --primary-accent: #3b82f6;
            --gradient-1: linear-gradient(135deg, #6366f1 0%, #a855f7 50%, #ec4899 100%);
            --gradient-text: linear-gradient(135deg, #38bdf8, #818cf8, #c084fc);
        }

        body {
            font-family: 'Cairo', sans-serif;
            background-color: var(--bg-dark);
            color: #f1f5f9;
            overflow-x: hidden;
        }

        /* Glassmorphism Navbar */
        .navbar-glass {
            background: rgba(15, 23, 42, 0.85);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.08);
        }

        .brand-logo {
            font-weight: 900;
            font-size: 1.6rem;
            background: var(--gradient-text);
            background-clip: text;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        /* Hero Section */
        .hero-section {
            position: relative;
            padding: 130px 0 70px;
            background: radial-gradient(circle at 50% 20%, rgba(99, 102, 241, 0.15) 0%, rgba(9, 13, 22, 1) 70%);
        }

        .hero-badge {
            background: rgba(99, 102, 241, 0.1);
            border: 1px solid rgba(99, 102, 241, 0.3);
            color: #818cf8;
            padding: 8px 20px;
            border-radius: 50px;
            font-size: 0.9rem;
            font-weight: 700;
            display: inline-block;
            margin-bottom: 20px;
        }

        .hero-title {
            font-weight: 900;
            font-size: 3.2rem;
            line-height: 1.25;
        }

        .text-gradient {
            background: var(--gradient-text);
            background-clip: text;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        /* Tabs Styling */
        .nav-pills-custom .nav-link {
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.1);
            color: #94a3b8;
            border-radius: 16px;
            padding: 12px 28px;
            font-weight: 700;
            transition: all 0.3s ease;
        }

        .nav-pills-custom .nav-link.active {
            background: var(--gradient-1);
            color: #fff;
            border-color: transparent;
            box-shadow: 0 8px 25px rgba(168, 85, 247, 0.3);
        }

        /* Cards */
        .custom-card {
            background: var(--card-bg);
            border: 1px solid rgba(255, 255, 255, 0.07);
            border-radius: 24px;
            overflow: hidden;
            transition: all 0.4s ease;
        }

        .custom-card:hover {
            transform: translateY(-8px);
            border-color: rgba(99, 102, 241, 0.4);
            box-shadow: 0 20px 40px -15px rgba(99, 102, 241, 0.3);
            background: rgba(30, 41, 59, 0.7);
        }

        .img-wrapper {
            position: relative;
            height: 220px;
            overflow: hidden;
            background: #0f172a;
        }

        .product-img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.6s ease;
        }

        .custom-card:hover .product-img {
            transform: scale(1.08);
        }

        .badge-verified {
            position: absolute;
            top: 15px;
            right: 15px;
            background: rgba(15, 23, 42, 0.85);
            backdrop-filter: blur(8px);
            color: #38bdf8;
            border: 1px solid rgba(56, 189, 248, 0.3);
            font-size: 0.75rem;
            font-weight: 700;
            padding: 6px 14px;
            border-radius: 50px;
        }

        .price-text {
            font-size: 1.4rem;
            font-weight: 800;
            color: #38bdf8;
        }

        /* Buttons */
        .btn-modern-primary {
            background: var(--gradient-1);
            color: #fff;
            border: none;
            border-radius: 12px;
            font-weight: 700;
            padding: 10px 20px;
            transition: all 0.3s;
        }

        .btn-modern-primary:hover {
            opacity: 0.95;
            color: #fff;
            transform: scale(1.02);
        }

        .btn-modern-outline {
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.15);
            color: #f1f5f9;
            border-radius: 12px;
            font-weight: 600;
            padding: 10px 20px;
            transition: all 0.3s;
        }

        .btn-modern-outline:hover {
            background: rgba(255, 255, 255, 0.15);
            color: #fff;
        }

        /* Offcanvas & Modals */
        .offcanvas-dark,
        .modal-content-dark {
            background-color: var(--modal-bg);
            color: #f1f5f9;
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        .form-control-dark {
            background-color: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.15);
            color: #fff;
            border-radius: 10px;
        }

        .form-control-dark:focus {
            background-color: rgba(255, 255, 255, 0.1);
            border-color: #6366f1;
            color: #fff;
            box-shadow: none;
        }

        .fs-7 {
            font-size: 0.85rem;
        }

        .fs-8 {
            font-size: 0.75rem;
        }
    </style>
</head>

<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top navbar-glass py-3">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center gap-2" href="#">
                <div class="bg-primary rounded-3 p-2 d-flex align-items-center justify-content-center" style="width:40px; height:40px;">
                    <i class="bi bi-shield-lock-fill text-white fs-5"></i>
                </div>
                <span class="brand-logo">NEXUS VAULT</span>
            </a>

            <div class="d-flex align-items-center gap-3">
                <button class="btn btn-modern-outline position-relative" type="button" data-bs-toggle="offcanvas" data-bs-target="#cartOffcanvas">
                    <i class="bi bi-cart3 fs-5"></i>
                    <span id="cartBadge" class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger d-none">0</span>
                </button>

                @auth
                    @if(in_array(auth()->user()->role ?? '', ['admin', 'adminRole']))
                        <a href="{{ route('admin.products.index') }}" class="btn btn-outline-light btn-sm">
                            <i class="bi bi-speedometer2 me-1"></i> لوحة التحكم
                        </a>
                    @endif
                @else
                    <a href="{{ route('login') }}" class="btn btn-modern-primary btn-sm">
                        <i class="bi bi-person-fill me-1"></i> تسجيل الدخول
                    </a>
                @endauth
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero-section text-center">
        <div class="container" data-aos="fade-up">
            <div class="hero-badge">
                <i class="bi bi-cpu-fill me-1"></i> المنصة الأولى للضمان الرقمي والتسوق المعتمد
            </div>
            <h1 class="hero-title mb-4">
                تصفح المنتجات الجديدة <br>وإدارة <span class="text-gradient">خزنة ملكيتك الرقمية</span>
            </h1>
            <p class="text-secondary fs-5 col-md-8 mx-auto mb-5">
                إدارة كاملة للمتجر الرقمي، وثائق الضمان بالسيريال، وسوق إعادة بيع الأجهزة المستعملة ونقل الملكية بين المستخدمين.
            </p>

            <ul class="nav nav-pills nav-pills-custom justify-content-center gap-3 mb-5" id="mainTabs" role="tablist">
                <li class="nav-item">
                    <button class="nav-link active" id="store-tab" data-bs-toggle="pill" data-bs-target="#store-content" type="button">
                        <i class="bi bi-bag-check-fill me-2"></i>المتجر الرسمي (Multi-Vendor)
                    </button>
                </li>
                <li class="nav-item">
                    <button class="nav-link" id="vault-tab" data-bs-toggle="pill" data-bs-target="#vault-content" type="button">
                        <i class="bi bi-journal-bookmark-fill me-2"></i>خزنة أجهزتي والضمان (Tech Vault)
                    </button>
                </li>
                <li class="nav-item">
                    <button class="nav-link" id="resale-tab" data-bs-toggle="pill" data-bs-target="#resale-content" type="button">
                        <i class="bi bi-arrow-repeat me-2"></i>سوق المستعمل المعتمد (Resale)
                    </button>
                </li>
            </ul>
        </div>
    </section>

    <!-- Main Content Area -->
    <section class="pb-5">
        <div class="container">
            <div class="tab-content" id="mainTabsContent">

                <!-- 1️⃣ المتجر الرسمي -->
                <div class="tab-pane fade show active" id="store-content" role="tabpanel">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h4 class="fw-bold text-white mb-0"><i class="bi bi-shop text-primary me-2"></i>منتجات التجار المعتمدة</h4>
                        <span class="badge bg-dark border border-secondary px-3 py-2 rounded-pill fs-7">
                            عدد المنتجات: {{ count($approvedProducts ?? []) }}
                        </span>
                    </div>

                    <div class="row g-4">
                        @forelse($approvedProducts ?? [] as $product)
                        <div class="col-sm-6 col-lg-4">
                            <div class="custom-card h-100 d-flex flex-column">
                                <div class="img-wrapper">
                                    <span class="badge-verified"><i class="bi bi-patch-check-fill me-1"></i> جديد بضمان</span>
                                    <img src="{{ $product->image ?? $product->photo ?? 'https://images.unsplash.com/photo-1511707171634-5f897ff02aa9?q=80&w=800' }}" class="product-img" alt="{{ $product->name }}">
                                </div>
                                <div class="p-4 d-flex flex-column flex-grow-1">
                                    <h5 class="fw-bold text-white mb-2">{{ $product->name }}</h5>
                                    <p class="text-secondary fs-7 mb-4 flex-grow-1">{{ Str::limit($product->description ?? '', 80) }}</p>
                                    <div class="d-flex justify-content-between align-items-center pt-3 border-top border-secondary border-opacity-25">
                                        <div>
                                            <span class="text-secondary d-block fs-8">السعر</span>
                                            <span class="price-text">${{ number_format($product->price ?? 0, 2) }}</span>
                                        </div>
                                        <button class="btn btn-modern-primary add-to-cart-btn"
                                            data-id="{{ $product->id }}"
                                            data-name="{{ $product->name }}"
                                            data-price="{{ $product->price }}"
                                            data-image="{{ $product->image ?? $product->photo ?? 'https://images.unsplash.com/photo-1511707171634-5f897ff02aa9?q=80&w=800' }}">
                                            <i class="bi bi-cart-plus me-1"></i> إضافة للسلة
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @empty
                        <div class="col-12 text-center py-5">
                            <p class="text-secondary">لا توجد منتجات معروضة حالياً.</p>
                        </div>
                        @endforelse
                    </div>
                </div>

                <!-- 2️⃣ خزنة الأجهزة والضمان الرقمي -->
                <div class="tab-pane fade" id="vault-content" role="tabpanel">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h4 class="fw-bold text-white mb-0"><i class="bi bi-shield-check text-success me-2"></i>جوازات أجهزتك المسجلة</h4>
                    </div>

                    <div class="row g-4" id="vaultContainer">
                        @forelse($myPassports ?? [] as $passport)
                        <div class="col-md-6 col-lg-4" id="vault-item-{{ $loop->index }}">
                            <div class="custom-card p-4">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <span class="badge bg-success bg-opacity-25 text-success border border-success border-opacity-25 rounded-pill px-3 py-1 fs-8">ضمان ساري</span>
                                    <small class="text-secondary fs-8">SN: {{ $passport->serial_number }}</small>
                                </div>
                                <h5 class="fw-bold text-white mb-1">{{ $passport->product->name ?? $passport->product_name ?? 'جهاز ذكي' }}</h5>
                                <p class="text-secondary fs-7 mb-3">ينتهي الضمان في: {{ $passport->warranty_expires_at }}</p>
                                <div class="d-flex gap-2">
                                    <button class="btn btn-modern-outline btn-sm w-100"
                                        data-name="{{ $passport->product->name ?? $passport->product_name ?? 'الجهاز' }}"
                                        data-serial="{{ $passport->serial_number }}"
                                        onclick="openMaintenanceModal(this)">
                                        <i class="bi bi-wrench me-1"></i> طلب صيانة
                                    </button>
                                    <button class="btn btn-modern-primary btn-sm w-100"
                                        data-name="{{ $passport->product->name ?? $passport->product_name ?? 'الجهاز' }}"
                                        data-serial="{{ $passport->serial_number }}"
                                        data-target="vault-item-{{ $loop->index }}"
                                        onclick="openResaleModal(this)">
                                        <i class="bi bi-tag me-1"></i> عرض للبيع
                                    </button>
                                </div>
                            </div>
                        </div>
                        @empty
                        <div class="col-12 text-center py-5">
                            <p class="text-secondary">لم تقم بتسجيل أي أجهزة في خزنتك الرقمية بعد.</p>
                        </div>
                        @endforelse
                    </div>
                </div>

                <!-- 3️⃣ سوق المستعمل المعتمد -->
                <div class="tab-pane fade" id="resale-content" role="tabpanel">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h4 class="fw-bold text-white mb-0"><i class="bi bi-arrow-left-right text-info me-2"></i>سوق المستعمل مفحوص ومضمون</h4>
                    </div>

                    <div class="row g-4" id="resaleContainer">
                        @forelse($resaleListings ?? [] as $index => $listing)
                        <div class="col-sm-6 col-lg-4" id="resale-item-{{ $index }}">
                            <div class="custom-card p-4">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <span class="badge bg-info bg-opacity-25 text-info border border-info border-opacity-25 rounded-pill px-3 py-1 fs-8">مستعمل موثق</span>
                                    <span class="price-text fs-6">${{ number_format($listing->asking_price ?? 0, 2) }}</span>
                                </div>
                                <h5 class="fw-bold text-white mb-2">{{ $listing->devicePassport->product->name ?? $listing->device_name ?? 'منتج مستعمل' }}</h5>
                                <p class="text-secondary fs-7 mb-3">{{ $listing->seller_notes ?? 'لا توجد ملاحظات من البائع.' }}</p>
                                <button class="btn btn-modern-primary w-100"
                                    data-name="{{ $listing->devicePassport->product->name ?? $listing->device_name ?? 'المنتج' }}"
                                    data-price="{{ $listing->asking_price }}"
                                    data-target="resale-item-{{ $index }}"
                                    onclick="openTransferModal(this)">
                                    <i class="bi bi-check-circle me-1"></i> شراء ونقل الملكية
                                </button>
                            </div>
                        </div>
                        @empty
                        <div class="col-12 text-center py-5">
                            <p class="text-secondary">لا توجد أجهزة مستعملة معروضة للبيع حالياً.</p>
                        </div>
                        @endforelse
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- Modal 1: طلب صيانة -->
    <div class="modal fade" id="maintenanceModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content modal-content-dark">
                <div class="modal-header border-secondary border-opacity-25">
                    <h5 class="modal-title fw-bold text-white"><i class="bi bi-wrench text-warning me-2"></i>طلب صيانة وإصلاح</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <p class="text-secondary fs-7 mb-3">الجهاز: <strong id="maintDeviceName" class="text-white"></strong> (<span id="maintSerial"></span>)</p>
                    <div class="mb-3">
                        <label class="form-label fs-7">وصف المشكلة أو العطل:</label>
                        <textarea id="maintNotes" class="form-control form-control-dark" rows="3" placeholder="اشرح المشكلة التي تواجهها بالتفصيل..."></textarea>
                    </div>
                </div>
                <div class="modal-footer border-secondary border-opacity-25">
                    <button type="button" class="btn btn-modern-outline" data-bs-dismiss="modal">إلغاء</button>
                    <button type="button" onclick="submitMaintenance()" class="btn btn-modern-primary">إرسال البلاغ</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal 2: عرض الجهاز للبيع -->
    <div class="modal fade" id="resaleModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content modal-content-dark">
                <div class="modal-header border-secondary border-opacity-25">
                    <h5 class="modal-title fw-bold text-white"><i class="bi bi-tag text-info me-2"></i>عرض الجهاز للبيع</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <p class="text-secondary fs-7 mb-3">الجهاز المراد بيعه: <strong id="sellDeviceName" class="text-white"></strong></p>
                    <div class="mb-3">
                        <label class="form-label fs-7">السعر المطلوب ($):</label>
                        <input type="number" id="sellPrice" class="form-control form-control-dark" placeholder="مثال: 450">
                    </div>
                    <div class="mb-3">
                        <label class="form-label fs-7">ملاحظات وحالة الجهاز:</label>
                        <textarea id="sellNotes" class="form-control form-control-dark" rows="3" placeholder="اكتب ملاحظات عن حالة البطارية أو الملحقات..."></textarea>
                    </div>
                </div>
                <div class="modal-footer border-secondary border-opacity-25">
                    <button type="button" class="btn btn-modern-outline" data-bs-dismiss="modal">إلغاء</button>
                    <button type="button" onclick="submitResale()" class="btn btn-modern-primary">نشر في سوق المستعمل</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal 3: تأكيد نقل الملكية للشراء -->
    <div class="modal fade" id="transferModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content modal-content-dark">
                <div class="modal-header border-secondary border-opacity-25">
                    <h5 class="modal-title fw-bold text-white"><i class="bi bi-shield-check text-success me-2"></i>تأكيد نقل الملكية والشراء</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body text-center py-4">
                    <i class="bi bi-arrow-repeat text-primary display-4 mb-3 d-block"></i>
                    <h5 class="fw-bold text-white mb-2" id="transferDeviceName"></h5>
                    <p class="text-secondary fs-7 mb-3">سيتم خصم المبلغ وتوثيق السيريال نمبر باسمك في الخزنة الرقمية مباشرة.</p>
                    <h4 class="price-text mb-0" id="transferPrice"></h4>
                </div>
                <div class="modal-footer border-secondary border-opacity-25">
                    <button type="button" class="btn btn-modern-outline" data-bs-dismiss="modal">إلغاء</button>
                    <button type="button" onclick="submitTransfer()" class="btn btn-modern-primary">تأكيد ونقل الملكية</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Offcanvas Cart Drawer (سلة الشراء الجانبية) -->
    <div class="offcanvas offcanvas-start offcanvas-dark" tabindex="-1" id="cartOffcanvas">
        <div class="offcanvas-header border-bottom border-secondary border-opacity-25 py-3">
            <h5 class="offcanvas-title fw-bold text-white"><i class="bi bi-cart3 text-primary me-2"></i>سلة التسوق</h5>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas"></button>
        </div>
        <div class="offcanvas-body d-flex flex-column justify-content-between">
            <div id="cartItemsContainer" class="d-flex flex-column gap-3 overflow-auto"></div>
            <div class="border-top border-secondary border-opacity-25 pt-3 mt-3">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <span class="text-secondary fs-6">الإجمالي:</span>
                    <span id="cartTotalPrice" class="price-text fs-4">$0.00</span>
                </div>
                <button id="checkoutBtn" class="btn btn-modern-primary w-100 py-2 fs-6" disabled onclick="checkout()">
                    <i class="bi bi-credit-card me-2"></i>إتمام الشراء الآن
                </button>
            </div>
        </div>
    </div>

    <!-- Toast Notification -->
    <div class="toast-container position-fixed bottom-0 end-0 p-3" style="z-index: 9999;">
        <div id="actionToast" class="toast align-items-center text-bg-success border-0" role="alert">
            <div class="d-flex">
                <div class="toast-body" id="toastMessage">تمت العملية بنجاح!</div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
            </div>
        </div>
    </div>

    <!-- JS Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

    <!-- Interactive Logic Script -->
    <script>
        AOS.init({
            duration: 800,
            once: true
        });

        let activeItemElementId = null;
        let activeDeviceData = {};
        let cartItems = [];

        function showToast(msg, bgClass = 'text-bg-success') {
            const toastEl = document.getElementById('actionToast');
            toastEl.className = `toast align-items-center ${bgClass} border-0`;
            document.getElementById('toastMessage').textContent = msg;
            new bootstrap.Toast(toastEl).show();
        }

        function openMaintenanceModal(btn) {
            const name = btn.dataset.name;
            const serial = btn.dataset.serial;

            document.getElementById('maintDeviceName').textContent = name;
            document.getElementById('maintSerial').textContent = serial;
            document.getElementById('maintNotes').value = '';
            new bootstrap.Modal(document.getElementById('maintenanceModal')).show();
        }

        function submitMaintenance() {
            const notes = document.getElementById('maintNotes').value;
            if (!notes) {
                alert('برجاء كتابة تفاصيل العطل');
                return;
            }
            bootstrap.Modal.getInstance(document.getElementById('maintenanceModal')).hide();
            showToast('تم إرسال طلب الصيانة للفنيين بنجاح!');
        }

        function openResaleModal(btn) {
            const name = btn.dataset.name;
            const serial = btn.dataset.serial;
            const elementId = btn.dataset.target;

            activeItemElementId = elementId;
            activeDeviceData = { name, serial };
            document.getElementById('sellDeviceName').textContent = name;
            document.getElementById('sellPrice').value = '';
            document.getElementById('sellNotes').value = '';
            new bootstrap.Modal(document.getElementById('resaleModal')).show();
        }

        function submitResale() {
            const price = document.getElementById('sellPrice').value;
            const notes = document.getElementById('sellNotes').value || 'حالة ممتازة وبحالة الزيرو';
            if (!price) {
                alert('برجاء تحديد السعر');
                return;
            }

            const container = document.getElementById('resaleContainer');
            const newIndex = Date.now();
            container.innerHTML += `
                <div class="col-sm-6 col-lg-4" id="resale-item-${newIndex}">
                    <div class="custom-card p-4">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <span class="badge bg-info bg-opacity-25 text-info border border-info border-opacity-25 rounded-pill px-3 py-1 fs-8">مستعمل موثق</span>
                            <span class="price-text fs-6">$${parseFloat(price).toFixed(2)}</span>
                        </div>
                        <h5 class="fw-bold text-white mb-2">${activeDeviceData.name}</h5>
                        <p class="text-secondary fs-7 mb-3">${notes}</p>
                        <button class="btn btn-modern-primary w-100"
                                data-name="${activeDeviceData.name}"
                                data-price="${price}"
                                data-target="resale-item-${newIndex}"
                                onclick="openTransferModal(this)">
                            <i class="bi bi-check-circle me-1"></i> شراء ونقل الملكية
                        </button>
                    </div>
                </div>
            `;

            if (activeItemElementId) {
                const item = document.getElementById(activeItemElementId);
                if (item) item.remove();
            }

            bootstrap.Modal.getInstance(document.getElementById('resaleModal')).hide();
            showToast('تمت إضافته بنجاح لسوق المستعمل المعتمد!');
        }

        function openTransferModal(btn) {
            const name = btn.dataset.name;
            const price = btn.dataset.price;
            const elementId = btn.dataset.target;

            activeItemElementId = elementId;
            activeDeviceData = { name, price };
            document.getElementById('transferDeviceName').textContent = name;
            document.getElementById('transferPrice').textContent = `$${parseFloat(price).toFixed(2)}`;
            new bootstrap.Modal(document.getElementById('transferModal')).show();
        }

        function submitTransfer() {
            const vault = document.getElementById('vaultContainer');
            const newSerial = 'SN-RESALE-' + Math.floor(100000 + Math.random() * 900000);
            const newIndex = Date.now();

            vault.innerHTML += `
                <div class="col-md-6 col-lg-4" id="vault-item-${newIndex}">
                    <div class="custom-card p-4">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <span class="badge bg-success bg-opacity-25 text-success border border-success border-opacity-25 rounded-pill px-3 py-1 fs-8">ضمان ساري</span>
                            <small class="text-secondary fs-8">SN: ${newSerial}</small>
                        </div>
                        <h5 class="fw-bold text-white mb-1">${activeDeviceData.name}</h5>
                        <p class="text-secondary fs-7 mb-3">ينتهي الضمان في: 2027-12-31</p>
                        <div class="d-flex gap-2">
                            <button class="btn btn-modern-outline btn-sm w-100"
                                    data-name="${activeDeviceData.name}"
                                    data-serial="${newSerial}"
                                    onclick="openMaintenanceModal(this)">
                                <i class="bi bi-wrench me-1"></i> طلب صيانة
                            </button>
                            <button class="btn btn-modern-primary btn-sm w-100"
                                    data-name="${activeDeviceData.name}"
                                    data-serial="${newSerial}"
                                    data-target="vault-item-${newIndex}"
                                    onclick="openResaleModal(this)">
                                <i class="bi bi-tag me-1"></i> عرض للبيع
                            </button>
                        </div>
                    </div>
                </div>
            `;

            if (activeItemElementId) {
                const item = document.getElementById(activeItemElementId);
                if (item) item.remove();
            }

            bootstrap.Modal.getInstance(document.getElementById('transferModal')).hide();
            showToast('تم نقل الملكية وتوثيق الضمان في خزنتك الرقمية!');
        }

        document.querySelectorAll('.add-to-cart-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                const id = this.dataset.id;
                const name = this.dataset.name;
                const price = parseFloat(this.dataset.price);
                const image = this.dataset.image;

                cartItems.push({ id, name, price, image });
                updateCartUI();
                showToast(`تمت إضافة ${name} إلى سلة التسوق`);
            });
        });

        function updateCartUI() {
            const container = document.getElementById('cartItemsContainer');
            const badge = document.getElementById('cartBadge');
            const totalEl = document.getElementById('cartTotalPrice');
            const checkoutBtn = document.getElementById('checkoutBtn');

            if (cartItems.length > 0) {
                badge.classList.remove('d-none');
                badge.textContent = cartItems.length;
                checkoutBtn.removeAttribute('disabled');
            } else {
                badge.classList.add('d-none');
                checkoutBtn.setAttribute('disabled', 'true');
            }

            container.innerHTML = '';
            let total = 0;

            cartItems.forEach((item, index) => {
                total += item.price;
                container.innerHTML += `
                    <div class="d-flex align-items-center justify-content-between p-2 rounded bg-dark border border-secondary border-opacity-25">
                        <div class="d-flex align-items-center gap-2">
                            <img src="${item.image}" alt="${item.name}" class="rounded" style="width: 45px; height: 45px; object-fit: cover;">
                            <div>
                                <h6 class="mb-0 fs-7 text-white">${item.name}</h6>
                                <small class="text-info">$${item.price.toFixed(2)}</small>
                            </div>
                        </div>
                        <button class="btn btn-sm text-danger" onclick="removeFromCart(${index})">
                            <i class="bi bi-trash"></i>
                        </button>
                    </div>
                `;
            });

            totalEl.textContent = `$${total.toFixed(2)}`;
        }

        function removeFromCart(index) {
            cartItems.splice(index, 1);
            updateCartUI();
        }

        function checkout() {
            if (cartItems.length === 0) return;
            cartItems = [];
            updateCartUI();
            const offcanvasEl = document.getElementById('cartOffcanvas');
            bootstrap.Offcanvas.getInstance(offcanvasEl).hide();
            showToast('تمت عملية الشراء بنجاح وإضافة المنتجات للضمان!');
        }
    </script>
</body>
</html>
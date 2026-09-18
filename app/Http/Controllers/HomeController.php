<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class HomeController extends Controller
{
    public function index()
    {
        // 1️⃣ منتجات المتجر الرسمي
        $approvedProducts = Product::withoutGlobalScopes()->get();

        if ($approvedProducts->isEmpty()) {
            $approvedProducts = collect([
                (object)[
                    'id' => 1,
                    'name' => 'MacBook Pro 16 M3 Max',
                    'description' => 'شريحة M3 Max مع ذاكرة 36GB وهارد 1TB SSD وشاشة Liquid Retina XDR فائقة الوضوح.',
                    'price' => 3499.00,
                    'image' => 'https://images.unsplash.com/photo-1517336714731-489689fd1ca8?auto=format&fit=crop&w=800&q=80'
                ],
                (object)[
                    'id' => 2,
                    'name' => 'iPhone 15 Pro Max 512GB',
                    'description' => 'هيكل تيتانيوم متين، كاميرا احترافية 48MP مع تقريب بصري 5x وزر إجراءات قابل للتخصيص.',
                    'price' => 1399.00,
                    'image' => 'https://images.unsplash.com/photo-1695048133142-1a20484d2569?auto=format&fit=crop&w=800&q=80'
                ],
                (object)[
                    'id' => 3,
                    'name' => 'Samsung Galaxy S24 Ultra',
                    'description' => 'معالج Snapdragon 8 Gen 3 وشاشة AMOLED 6.8 بوصة وقلم S-Pen مع تقنيات الذكاء الاصطناعي.',
                    'price' => 1299.00,
                    'image' => 'https://images.unsplash.com/photo-1610945265064-0e34e5519bbf?auto=format&fit=crop&w=800&q=80'
                ],
                (object)[
                    'id' => 4,
                    'name' => 'Sony WH-1000XM5 Headphones',
                    'description' => 'سماعات الرأس الأعلى تقييماً في إلغاء الضوضاء، جودة صوت Hi-Res وبطارية تدوم 30 ساعة.',
                    'price' => 399.00,
                    'image' => 'https://images.unsplash.com/photo-1505740420928-5e560c06d30e?auto=format&fit=crop&w=800&q=80'
                ],
                (object)[
                    'id' => 5,
                    'name' => 'iPad Air M2 11-inch',
                    'description' => 'أداء مذهل بفضل شريحة Apple M2، يدعم قلم Apple Pencil Pro ولوحة مفاتيح Magic Keyboard.',
                    'price' => 599.00,
                    'image' => 'https://images.unsplash.com/photo-1544244015-0df4b3ffc6b0?auto=format&fit=crop&w=800&q=80'
                ],
                (object)[
                    'id' => 6,
                    'name' => 'Apple Watch Series 9',
                    'description' => 'شاشة أكثر سطوعاً مع ميزة الضغط المزدوج بدون لمس ومراقبة صحية متقدمة ومستشعر O2.',
                    'price' => 429.00,
                    'image' => 'https://images.unsplash.com/photo-1508685096489-7aacd43bd3b1?auto=format&fit=crop&w=800&q=80'
                ],
                (object)[
                    'id' => 7,
                    'name' => 'Dell XPS 13 Laptop',
                    'description' => 'تصميم عصري فائق النحافة، شاشة Touch OLED 4K ومعالج Intel Core i7 من الجيل الـ 13.',
                    'price' => 1649.00,
                    'image' => 'https://images.unsplash.com/photo-1593642632823-8f785ba67e45?auto=format&fit=crop&w=800&q=80'
                ],
                (object)[
                    'id' => 8,
                    'name' => 'Sony PlayStation 5 Digital',
                    'description' => 'تجربة ألعاب الجيل الجديد بدقة 4K مع وحدة تخزين ultra-fast SSD وتأثيرات Haptic Feedback.',
                    'price' => 449.00,
                    'image' => 'https://images.unsplash.com/photo-1606813907291-d86efa9b94db?auto=format&fit=crop&w=800&q=80'
                ],
                (object)[
                    'id' => 9,
                    'name' => 'Canon EOS R6 Camera',
                    'description' => 'كاميرا احترافية بدون مرآة (Full-Frame) بتصوير سريع 40fps وتصوير فيديو 4K 60p بدون قص.',
                    'price' => 2499.00,
                    'image' => 'https://images.unsplash.com/photo-1516035069371-29a1b244cc32?auto=format&fit=crop&w=800&q=80'
                ],
                (object)[
                    'id' => 10,
                    'name' => 'ASUS Gaming Laptop',
                    'description' => 'لاب توب ألعاب قوي بشاشة OLED 240Hz وكارت شاشة NVIDIA RTX 4080 لتشغيل أعلى الألعاب.',
                    'price' => 2299.00,
                    'image' => 'https://images.unsplash.com/photo-1603302576837-37561b2e2302?auto=format&fit=crop&w=800&q=80'
                ],
                (object)[
                    'id' => 11,
                    'name' => 'Bose Bluetooth Speaker',
                    'description' => 'سماعة بلوتوث محمولة بصوت ستيريو عالي النقاوة، مقاومة للماء والأتربة بمعيار IP67.',
                    'price' => 399.00,
                    'image' => 'https://images.unsplash.com/photo-1545454675-3531b543be5d?auto=format&fit=crop&w=800&q=80'
                ],
                (object)[
                    'id' => 12,
                    'name' => 'Mechanical Gaming Keyboard',
                    'description' => 'لوحة مفاتيح ميكانيكية مخصصة بآليّة الحفر CNC والبرمجة بالكامل عبر QMK/VIA بجسم ألومنيوم.',
                    'price' => 199.00,
                    'image' => 'https://images.unsplash.com/photo-1587829741301-dc798b83add3?auto=format&fit=crop&w=800&q=80'
                ]
            ]);
        }

        // 2️⃣ خزنة الأجهزة والضمان الرقمي (Tech Vault)
        if (Schema::hasTable('device_passports') && DB::table('device_passports')->count() > 0) {
            $myPassports = DB::table('device_passports')->get();
        } else {
            $myPassports = collect([
                (object)[
                    'product' => (object)['name' => 'MacBook Pro 16 M3 Max'],
                    'product_name' => 'MacBook Pro 16 M3 Max',
                    'serial_number' => 'SN-APP-998231',
                    'warranty_expires_at' => '2027-11-15',
                    'image' => 'https://images.unsplash.com/photo-1517336714731-489689fd1ca8?auto=format&fit=crop&w=800&q=80'
                ],
                (object)[
                    'product' => (object)['name' => 'iPhone 15 Pro Max 512GB'],
                    'product_name' => 'iPhone 15 Pro Max 512GB',
                    'serial_number' => 'SN-IP15-443109',
                    'warranty_expires_at' => '2026-09-30',
                    'image' => 'https://images.unsplash.com/photo-1695048133142-1a20484d2569?auto=format&fit=crop&w=800&q=80'
                ],
                (object)[
                    'product' => (object)['name' => 'Sony PlayStation 5 Slim'],
                    'product_name' => 'Sony PlayStation 5 Slim',
                    'serial_number' => 'SN-PS5-1102938',
                    'warranty_expires_at' => '2026-12-01',
                    'image' => 'https://images.unsplash.com/photo-1606813907291-d86efa9b94db?auto=format&fit=crop&w=800&q=80'
                ],
                (object)[
                    'product' => (object)['name' => 'Dell XPS 15 OLED'],
                    'product_name' => 'Dell XPS 15 OLED',
                    'serial_number' => 'SN-DELL-883721',
                    'warranty_expires_at' => '2027-01-20',
                    'image' => 'https://images.unsplash.com/photo-1593642632823-8f785ba67e45?auto=format&fit=crop&w=800&q=80'
                ],
                (object)[
                    'product' => (object)['name' => 'Apple Watch Ultra 2'],
                    'product_name' => 'Apple Watch Ultra 2',
                    'serial_number' => 'SN-WATCH-771029',
                    'warranty_expires_at' => '2027-05-10',
                    'image' => 'https://images.unsplash.com/photo-1508685096489-7aacd43bd3b1?auto=format&fit=crop&w=800&q=80'
                ]
            ]);
        }

        // 3️⃣ سوق المستعمل المعتمد (Resale Market)
        if (Schema::hasTable('resale_listings') && DB::table('resale_listings')->count() > 0) {
            $resaleListings = DB::table('resale_listings')->get();
        } else {
            $resaleListings = collect([
                (object)[
                    'devicePassport' => (object)['product' => (object)['name' => 'iPad Pro 12.9 M2 - 256GB']],
                    'device_name' => 'iPad Pro 12.9 M2 - 256GB',
                    'asking_price' => 850.00,
                    'seller_notes' => 'الجهاز بحالة كسر الزيرو مع العلبة وكابل الشحن الأصلي والضمان ساري.',
                    'image' => 'https://images.unsplash.com/photo-1544244015-0df4b3ffc6b0?auto=format&fit=crop&w=800&q=80'
                ],
                (object)[
                    'devicePassport' => (object)['product' => (object)['name' => 'Samsung Galaxy S23 Ultra']],
                    'device_name' => 'Samsung Galaxy S23 Ultra',
                    'asking_price' => 780.00,
                    'seller_notes' => 'استخدام خفيف جداً، الشاشة والظهر بدون أي خدوش، مع كافة الملحقات.',
                    'image' => 'https://images.unsplash.com/photo-1610945265064-0e34e5519bbf?auto=format&fit=crop&w=800&q=80'
                ],
                (object)[
                    'devicePassport' => (object)['product' => (object)['name' => 'AirPods Max Space Gray']],
                    'device_name' => 'AirPods Max - Space Gray',
                    'asking_price' => 410.00,
                    'seller_notes' => 'معها سوار أوريجينال إضافي، بطارية 98% واستعمال شهرين فقط.',
                    'image' => 'https://images.unsplash.com/photo-1505740420928-5e560c06d30e?auto=format&fit=crop&w=800&q=80'
                ],
                (object)[
                    'devicePassport' => (object)['product' => (object)['name' => 'Nintendo Switch OLED Edition']],
                    'device_name' => 'Nintendo Switch OLED Edition',
                    'asking_price' => 290.00,
                    'seller_notes' => 'شاملة كارت ذاكرة 256GB و3 ألعاب أصلية وحافظة حماية.',
                    'image' => 'https://images.unsplash.com/photo-1578303512597-81e6cc155b3e?auto=format&fit=crop&w=800&q=80'
                ]
            ]);
        }

        return view('welcome', compact('approvedProducts', 'myPassports', 'resaleListings'));
    }
}
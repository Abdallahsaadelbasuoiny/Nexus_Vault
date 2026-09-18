<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class ProductSeeder extends Seeder
{
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        DB::table('products')->truncate();
        Schema::enableForeignKeyConstraints();

        DB::table('products')->insert([
            [
                'name'        => 'لابتوب MacBook Pro M3 Max',
                'description' => 'شاشة 16 بوصة Liquid Retina XDR، ذاكرة 36GB، هارد 1TB SSD، معالج M3 Max.',
                'price'       => 2499.00,
                'image'       => 'https://images.unsplash.com/photo-1517336714731-489689fd1ca8?w=500',
                'created_at'  => now(),
                'updated_at'  => now(),
            ],
            [
                'name'        => 'هاتف iPhone 15 Pro Max',
                'description' => 'هيكل تيتانيوم، شريحة A17 Pro، كاميرا 48MP، مساحة تخزين 256GB.',
                'price'       => 1199.00,
                'image'       => 'https://images.unsplash.com/photo-1511707171634-5f897ff02aa9?w=500',
                'created_at'  => now(),
                'updated_at'  => now(),
            ],
            [
                'name'        => 'ساعة Apple Watch Series 9',
                'description' => 'مراقبة صحية متقدمة مع تتبع دقيق للأجسام واستشعار درجة الحرارة.',
                'price'       => 450.00,
                'image'       => 'https://images.unsplash.com/photo-1508685096489-7aacd43bd3b1?w=500',
                'created_at'  => now(),
                'updated_at'  => now(),
            ],
            [
                'name'        => 'لابتوب Gaming ASUS ROG Strix G16',
                'description' => 'معالج Intel Core i9-13980HX، كارت شاشة RTX 4070، رامات 32GB DDR5.',
                'price'       => 1850.00,
                'image'       => 'https://images.unsplash.com/photo-1603302576837-37561b2e2302?w=500',
                'created_at'  => now(),
                'updated_at'  => now(),
            ],
            [
                'name'        => 'شاشة Samsung Odyssey G7 27"',
                'description' => 'معدل تحديث 240Hz، دقة QHD، شاشة منحنية 1000R وزمن استجابة 1ms.',
                'price'       => 599.00,
                'image'       => 'https://images.unsplash.com/photo-1527443224154-c4a3942d3acf?w=500',
                'created_at'  => now(),
                'updated_at'  => now(),
            ],
            [
                'name'        => 'سماعات Sony WH-1000XM5',
                'description' => 'عزل ضوضاء فائق الذكاء، صوت عالي الدقة، بطارية تصل إلى 30 ساعة.',
                'price'       => 380.00,
                'image'       => 'https://images.unsplash.com/photo-1505740420928-5e560c06d30e?w=500',
                'created_at'  => now(),
                'updated_at'  => now(),
            ],
            [
                'name'        => 'هاتف Samsung Galaxy S24 Ultra',
                'description' => 'دعم الذكاء الاصطناعي Galaxy AI، قلم S-Pen مدمج، كاميرا 200MP.',
                'price'       => 1299.00,
                'image'       => 'https://images.unsplash.com/photo-1610945265064-0e34e5519bbf?w=500',
                'created_at'  => now(),
                'updated_at'  => now(),
            ],
            [
                'name'        => 'كارت شاشة Nvidia RTX 4090 OC',
                'description' => 'ذاكرة 24GB GDDR6X، تبريد احترافي، أداء قياسي للألعاب والرندر.',
                'price'       => 1799.00,
                'image'       => 'https://images.unsplash.com/photo-1587202372775-e229f172b9d7?w=500',
                'created_at'  => now(),
                'updated_at'  => now(),
            ],
            [
                'name'        => 'ماوس احترافي Logitech MX Master 3S',
                'description' => 'حساسية 8000 DPI، عجلة التمرير MagSpeed السريعة، نقرات هادئة جداً.',
                'price'       => 110.00,
                'image'       => 'https://images.unsplash.com/photo-1527864550417-7fd91fc51a46?w=500',
                'created_at'  => now(),
                'updated_at'  => now(),
            ],
            [
                'name'        => 'لوحة مفاتيح ميكانيكية Keychron K2',
                'description' => 'مفاتيح RGB قابلة للتخصيص، اتصال لاسلكي وسلكي، متوافقة مع Mac و Windows.',
                'price'       => 95.00,
                'image'       => 'https://images.unsplash.com/photo-1587829741301-dc798b83add3?w=500',
                'created_at'  => now(),
                'updated_at'  => now(),
            ],
            [
                'name'        => 'جهاز iPad Pro 12.9" M2',
                'description' => 'شاشة Liquid Retina XDR، دعم Apple Pencil 2، مساحة تخزين 512GB.',
                'price'       => 1099.00,
                'image'       => 'https://images.unsplash.com/photo-1544244015-0df4b3ffc6b0?w=500',
                'created_at'  => now(),
                'updated_at'  => now(),
            ],
            [
                'name'        => 'كاميرا Sony Alpha A7 IV',
                'description' => 'مستشعر فول فريم 33MP، تصوير فيديو 4K 60p، تركيز تلقائي ذكي.',
                'price'       => 2399.00,
                'image'       => 'https://images.unsplash.com/photo-1516035069371-29a1b244cc32?w=500',
                'created_at'  => now(),
                'updated_at'  => now(),
            ],
        ]);
    }
}
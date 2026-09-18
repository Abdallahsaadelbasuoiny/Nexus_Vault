<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // تعطيل القيود الخارجية لتجنب أخطاء Foreign Keys أثناء التفريغ والإدخال
        Schema::disableForeignKeyConstraints();

        // 1. إضافة بيانات خزنة الأجهزة (device_passports)
        if (Schema::hasTable('device_passports')) {
            DB::table('device_passports')->truncate();

            $passportData = [
                [
                    'id'                  => 1,
                    'owner_id'            => 1,
                    'user_id'             => 1,
                    'product_id'          => 1,
                    'serial_number'       => 'SN-APPLE-998231',
                    'purchase_date'       => '2024-11-15',
                    'warranty_expires_at' => '2027-11-15',
                    'status'              => 'active',
                    'created_at'          => now(),
                    'updated_at'          => now(),
                ],
                [
                    'id'                  => 2,
                    'owner_id'            => 1,
                    'user_id'             => 1,
                    'product_id'          => 2,
                    'serial_number'       => 'SN-IP15P-443109',
                    'purchase_date'       => '2024-09-30',
                    'warranty_expires_at' => '2026-09-30',
                    'status'              => 'active',
                    'created_at'          => now(),
                    'updated_at'          => now(),
                ],
                [
                    'id'                  => 3,
                    'owner_id'            => 1,
                    'user_id'             => 1,
                    'product_id'          => 3,
                    'serial_number'       => 'SN-PS5-1102938',
                    'purchase_date'       => '2024-12-01',
                    'warranty_expires_at' => '2026-12-01',
                    'status'              => 'active',
                    'created_at'          => now(),
                    'updated_at'          => now(),
                ],
                [
                    'id'                  => 4,
                    'owner_id'            => 1,
                    'user_id'             => 1,
                    'product_id'          => 4,
                    'serial_number'       => 'SN-DELL-883721',
                    'purchase_date'       => '2025-01-20',
                    'warranty_expires_at' => '2027-01-20',
                    'status'              => 'active',
                    'created_at'          => now(),
                    'updated_at'          => now(),
                ]
            ];
            $this->safeInsert('device_passports', $passportData);
        }

        // 2. إضافة بيانات سوق المستعمل (resale_listings)
        if (Schema::hasTable('resale_listings')) {
            DB::table('resale_listings')->truncate();

            $resaleData = [
                [
                    'id'                 => 1,
                    'device_passport_id' => 1,
                    'passport_id'        => 1,
                    'seller_id'          => 1,
                    'user_id'            => 1,
                    'seller_name'        => 'أحمد محمود',
                    'device_name'        => 'iPad Pro 12.9 M2 - 256GB',
                    'title'              => 'iPad Pro 12.9 M2 - 256GB',
                    'name'               => 'iPad Pro 12.9 M2 - 256GB',
                    'asking_price'       => 850.00,
                    'price'              => 850.00,
                    'seller_notes'       => 'الجهاز بحالة الزيرو مع العلبة وكابل الشحن الأصلي والضمان ساري.',
                    'description'        => 'الجهاز بحالة الزيرو مع العلبة وكابل الشحن الأصلي والضمان ساري.',
                    'status'             => 'available',
                    'created_at'         => now(),
                    'updated_at'         => now(),
                ],
                [
                    'id'                 => 2,
                    'device_passport_id' => 2,
                    'passport_id'        => 2,
                    'seller_id'          => 1,
                    'user_id'            => 1,
                    'seller_name'        => 'سارة علي',
                    'device_name'        => 'Samsung Galaxy S24 Ultra',
                    'title'              => 'Samsung Galaxy S24 Ultra',
                    'name'               => 'Samsung Galaxy S24 Ultra',
                    'asking_price'       => 920.00,
                    'price'              => 920.00,
                    'seller_notes'       => 'استخدام شهرين فقط بدون أي خدوش، مع شاشة حماية وشاحن سريع.',
                    'description'        => 'استخدام شهرين فقط بدون أي خدوش، مع شاشة حماية وشاحن سريع.',
                    'status'             => 'available',
                    'created_at'         => now(),
                    'updated_at'         => now(),
                ],
                [
                    'id'                 => 3,
                    'device_passport_id' => 3,
                    'passport_id'        => 3,
                    'seller_id'          => 1,
                    'user_id'            => 1,
                    'seller_name'        => 'محمد حسن',
                    'device_name'        => 'Apple Watch Ultra 2',
                    'title'              => 'Apple Watch Ultra 2',
                    'name'               => 'Apple Watch Ultra 2',
                    'asking_price'       => 600.00,
                    'price'              => 600.00,
                    'seller_notes'       => 'معها سوار أوريجينال إضافي، بطارية 99%.',
                    'description'        => 'معها سوار أوريجينال إضافي، بطارية 99%.',
                    'status'             => 'available',
                    'created_at'         => now(),
                    'updated_at'         => now(),
                ],
                [
                    'id'                 => 4,
                    'device_passport_id' => 4,
                    'passport_id'        => 4,
                    'seller_id'          => 1,
                    'user_id'            => 1,
                    'seller_name'        => 'عمر خالد',
                    'device_name'        => 'AirPods Max - Space Gray',
                    'title'              => 'AirPods Max - Space Gray',
                    'name'               => 'AirPods Max - Space Gray',
                    'asking_price'       => 410.00,
                    'price'              => 410.00,
                    'seller_notes'       => 'استعمال خفيف جداً، مع كافة الملحقات والعلبة الرسمية.',
                    'description'        => 'استعمال خفيف جداً، مع كافة الملحقات والعلبة الرسمية.',
                    'status'             => 'available',
                    'created_at'         => now(),
                    'updated_at'         => now(),
                ]
            ];
            $this->safeInsert('resale_listings', $resaleData);
        }

        Schema::enableForeignKeyConstraints();
    }

    /**
     * فلترة الأعمدة لإدخال الحقول الموجودة بالفعل في الهيكل دون أخطاء SQL
     */
    private function safeInsert(string $tableName, array $rows): void
    {
        $existingColumns = Schema::getColumnListing($tableName);
        $filteredRows = [];

        foreach ($rows as $row) {
            $filteredRow = [];
            foreach ($row as $key => $value) {
                if (in_array($key, $existingColumns)) {
                    $filteredRow[$key] = $value;
                }
            }
            if (!empty($filteredRow)) {
                $filteredRows[] = $filteredRow;
            }
        }

        if (!empty($filteredRows)) {
            DB::table($tableName)->insert($filteredRows);
        }
    }
}
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

return new class extends Migration
{
    public function up(): void
    {
        $now = now();

        $categories = [
            ['name' => 'اشتراک و سرویس', 'slug' => 'subscriptions'],
            ['name' => 'تلگرام و شبکه‌های اجتماعی', 'slug' => 'telegram-social'],
            ['name' => 'خدمات دیجیتال', 'slug' => 'digital-services'],
        ];

        foreach ($categories as $category) {
            DB::table('categories')->updateOrInsert(
                ['slug' => $category['slug']],
                [
                    'name' => $category['name'],
                    'description' => 'خدمات دیجیتال قابل سفارش از فروشگاه',
                    'is_active' => true,
                    'sort_order' => 0,
                    'created_at' => $now,
                    'updated_at' => $now,
                ],
            );
        }

        $categoryIds = DB::table('categories')->pluck('id', 'slug');

        $products = [
            [
                'category' => 'subscriptions',
                'name' => 'اشتراک پریمیوم سه‌ماهه',
                'slug' => 'premium-3-month',
                'description' => 'اشتراک سه‌ماهه پریمیوم با تحویل سریع.',
                'price' => 3490000,
                'old_price' => 3990000,
                'delivery_type' => 'employee',
                'delivery_minutes' => 30,
                'featured' => true,
                'fields' => [
                    ['name' => 'شماره موبایل', 'key' => 'mobile', 'type' => 'text', 'required' => true],
                ],
            ],
            [
                'category' => 'telegram-social',
                'name' => 'هدیه پریمیوم تلگرام',
                'slug' => 'telegram-premium-gift',
                'description' => 'ارسال هدیه پریمیوم تلگرام برای گیرنده.',
                'price' => 1850000,
                'old_price' => null,
                'delivery_type' => 'automatic',
                'delivery_minutes' => 10,
                'featured' => true,
                'fields' => [
                    ['name' => 'نام کاربری تلگرام', 'key' => 'telegram_username', 'type' => 'text', 'required' => true, 'description' => 'بدون @ وارد شود.'],
                ],
            ],
            [
                'category' => 'telegram-social',
                'name' => 'سرویس افزایش اعضای کانال',
                'slug' => 'channel-members',
                'description' => 'ثبت سفارش سرویس افزایش اعضای کانال.',
                'price' => 790000,
                'old_price' => 990000,
                'delivery_type' => 'employee',
                'delivery_minutes' => 120,
                'featured' => false,
                'fields' => [
                    ['name' => 'لینک کانال', 'key' => 'channel_link', 'type' => 'text', 'required' => true],
                    ['name' => 'تعداد', 'key' => 'quantity', 'type' => 'number', 'required' => true],
                ],
            ],
            [
                'category' => 'digital-services',
                'name' => 'خدمت دیجیتال سفارشی',
                'slug' => 'custom-digital-service',
                'description' => 'برای خدمات خاص با مشخصات دلخواه سفارش ثبت کنید.',
                'price' => 500000,
                'old_price' => null,
                'delivery_type' => 'admin',
                'delivery_minutes' => 240,
                'featured' => false,
                'fields' => [
                    ['name' => 'توضیحات سفارش', 'key' => 'details', 'type' => 'textarea', 'required' => true],
                ],
            ],
        ];

        foreach ($products as $data) {
            $categoryId = $categoryIds[$data['category']] ?? null;
            if (!$categoryId) {
                continue;
            }

            $productId = DB::table('products')->where('slug', $data['slug'])->value('id');
            $payload = [
                'category_id' => $categoryId,
                'name' => $data['name'],
                'slug' => $data['slug'],
                'description' => $data['description'],
                'price' => $data['price'],
                'old_price' => $data['old_price'],
                'currency' => 'IRR',
                'delivery_type' => $data['delivery_type'],
                'delivery_minutes' => $data['delivery_minutes'],
                'has_inventory' => false,
                'inventory' => null,
                'is_active' => true,
                'is_featured' => $data['featured'],
                'sort_order' => 0,
                'updated_at' => $now,
            ];

            if ($productId) {
                DB::table('products')->where('id', $productId)->update($payload);
            } else {
                $productId = DB::table('products')->insertGetId($payload + [
                    'created_at' => $now,
                ]);
            }

            foreach ($data['fields'] as $field) {
                DB::table('product_fields')->updateOrInsert(
                    ['product_id' => $productId, 'key' => $field['key']],
                    [
                        'name' => $field['name'],
                        'type' => $field['type'],
                        'description' => $field['description'] ?? null,
                        'validation_rules' => null,
                        'is_required' => $field['required'],
                        'is_active' => true,
                        'sort_order' => 0,
                        'created_at' => $now,
                        'updated_at' => $now,
                    ],
                );
            }
        }
    }

    public function down(): void
    {
        $productIds = DB::table('products')->whereIn('slug', [
            'premium-3-month', 'telegram-premium-gift', 'channel-members', 'custom-digital-service',
        ])->pluck('id');

        DB::table('product_fields')->whereIn('product_id', $productIds)->delete();
        DB::table('products')->whereIn('id', $productIds)->delete();
        DB::table('categories')->whereIn('slug', [
            'subscriptions', 'telegram-social', 'digital-services',
        ])->delete();
    }
};

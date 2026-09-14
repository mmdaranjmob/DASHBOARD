<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

return new class extends Migration
{
    public function up(): void
    {
        $now = now();

        $roles = [
            ['name' => 'مشتری', 'code' => 'customer'],
            ['name' => 'کارمند', 'code' => 'employee'],
            ['name' => 'مدیر', 'code' => 'admin'],
            ['name' => 'مدیر ارشد', 'code' => 'super_admin'],
        ];

        foreach ($roles as $role) {
            DB::table('roles')->updateOrInsert(
                ['code' => $role['code']],
                ['name' => $role['name'], 'created_at' => $now, 'updated_at' => $now]
            );
        }

        $categoryId = DB::table('categories')->where('slug', 'digital-services')->value('id');
        if (!$categoryId) {
            $categoryId = DB::table('categories')->insertGetId([
                'name' => 'خدمات دیجیتال',
                'slug' => 'digital-services',
                'description' => 'خدمات و محصولات دیجیتال فروشگاه',
                'is_active' => true,
                'sort_order' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ]);
        }

        $productId = DB::table('products')->where('slug', 'telegram-premium')->value('id');
        if (!$productId) {
            $productId = DB::table('products')->insertGetId([
                'category_id' => $categoryId,
                'name' => 'Telegram Premium',
                'slug' => 'telegram-premium',
                'description' => 'اشتراک پریمیوم تلگرام — محصول نمونه برای تست فروشگاه',
                'price' => 0,
                'old_price' => null,
                'currency' => 'IRR',
                'delivery_type' => 'automatic',
                'delivery_minutes' => 5,
                'has_inventory' => false,
                'inventory' => null,
                'is_active' => true,
                'is_featured' => true,
                'sort_order' => 1,
                'delivery_config' => json_encode(['provider' => 'telegram', 'mode' => 'gift']),
                'created_at' => $now,
                'updated_at' => $now,
            ]);
        }

        $exists = DB::table('product_fields')
            ->where('product_id', $productId)
            ->where('key', 'telegram_username')
            ->exists();

        if (!$exists) {
            DB::table('product_fields')->insert([
                'product_id' => $productId,
                'name' => 'نام کاربری تلگرام',
                'key' => 'telegram_username',
                'type' => 'text',
                'description' => 'نام کاربری گیرنده بدون @',
                'validation_rules' => json_encode(['max' => 64]),
                'is_required' => true,
                'is_active' => true,
                'sort_order' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ]);
        }
    }

    public function down(): void
    {
        $productId = DB::table('products')->where('slug', 'telegram-premium')->value('id');
        if ($productId) {
            DB::table('product_fields')->where('product_id', $productId)->delete();
            DB::table('products')->where('id', $productId)->delete();
        }

        DB::table('categories')->where('slug', 'digital-services')->delete();
        DB::table('roles')->whereIn('code', ['customer', 'employee', 'admin', 'super_admin'])->delete();
    }
};

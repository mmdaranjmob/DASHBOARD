<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        $now = now();

        foreach ([
            ['name' => 'مشتری', 'code' => 'customer'],
            ['name' => 'کارمند', 'code' => 'employee'],
            ['name' => 'مدیر', 'code' => 'admin'],
            ['name' => 'مدیر ارشد', 'code' => 'super_admin'],
        ] as $role) {
            DB::table('roles')->updateOrInsert(
                ['code' => $role['code']],
                ['name' => $role['name'], 'updated_at' => $now, 'created_at' => $now],
            );
        }
    }

    public function down(): void
    {
        DB::table('roles')->whereIn('code', [
            'customer', 'employee', 'admin', 'super_admin',
        ])->delete();
    }
};

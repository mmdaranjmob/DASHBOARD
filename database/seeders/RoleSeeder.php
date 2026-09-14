<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        $roles = [
            ['name' => 'مشتری', 'code' => 'customer'],
            ['name' => 'کارمند', 'code' => 'employee'],
            ['name' => 'مدیر', 'code' => 'admin'],
            ['name' => 'مدیر ارشد', 'code' => 'super_admin'],
        ];

        foreach ($roles as $role) {
            Role::updateOrCreate(['code' => $role['code']], $role);
        }
    }
}

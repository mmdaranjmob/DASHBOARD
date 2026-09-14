<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('mobile', 20)->nullable()->unique()->after('name');
            $table->string('national_id', 20)->nullable()->unique()->after('mobile');
            $table->string('status', 20)->default('active')->index()->after('password');
            $table->string('email')->nullable()->change();
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropUnique(['users_mobile_unique']);
            $table->dropUnique(['users_national_id_unique']);
            $table->dropIndex(['users_status_index']);
            $table->dropColumn(['mobile', 'national_id', 'status']);
            $table->string('email')->unique()->nullable(false)->change();
        });
    }
};

<?php

use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    public function up(): void
    {
        // Compatibility migration. The base users migration already owns these fields.
    }

    public function down(): void
    {
        // Intentionally a no-op; the base users migration owns the schema.
    }
};

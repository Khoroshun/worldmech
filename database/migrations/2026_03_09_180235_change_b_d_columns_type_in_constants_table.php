<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // очищаем значения
        DB::statement('UPDATE constants SET b = NULL');
        DB::statement('UPDATE constants SET d = NULL');

        // меняем тип
        DB::statement('
            ALTER TABLE constants
            ALTER COLUMN b TYPE double precision USING NULL::double precision
        ');

        DB::statement('
            ALTER TABLE constants
            ALTER COLUMN d TYPE double precision USING NULL::double precision
        ');
    }

    public function down(): void
    {
        DB::statement('
            ALTER TABLE constants
            ALTER COLUMN b TYPE varchar
        ');

        DB::statement('
            ALTER TABLE constants
            ALTER COLUMN d TYPE varchar
        ');
    }
};

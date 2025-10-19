<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('constants', function (Blueprint $table) {
            $table->id();

            // material_id integer NULL + FK (RESTRICT/NO ACTION на delete/update)
            $table->foreignId('material_id')
                ->nullable()
                ->constrained('materials')
                ->restrictOnDelete()
                ->restrictOnUpdate();

            $table->string('b', 255)->nullable();
            $table->string('d', 255)->nullable();

            $table->double('n')->nullable();
            $table->double('k')->nullable();
            $table->double('m')->nullable();
            $table->double('l')->nullable();
            $table->double('temperature')->nullable();
            $table->double('a')->nullable();

            $table->text('source')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('constants');
    }
};

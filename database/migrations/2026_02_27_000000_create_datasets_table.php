<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('datasets', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('x_label')->default('Temperature');
            $table->string('y_label');
            $table->string('x_unit')->nullable();
            $table->string('y_unit')->nullable();
            $table->enum('scale_type', ['linear', 'log'])->default('log');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('datasets');
    }
};


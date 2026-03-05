<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('data_points', function (Blueprint $table) {
            $table->id();
            $table->foreignId('dataset_id')
                ->constrained('datasets')
                ->cascadeOnDelete();
            $table->double('x_value');
            $table->double('y_value');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('data_points');
    }
};


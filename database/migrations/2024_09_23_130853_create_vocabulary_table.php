<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('vocabulary', function (Blueprint $table) {
            $table->id(); // Tạo trường id tự động tăng
            $table->string('word'); // Tạo trường word
            $table->string('meaning'); // Tạo trường meaning
            $table->text('example')->nullable(); // Tạo trường example, có thể rỗng
            $table->timestamps(); // Tạo trường created_at và updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vocabulary');
    }
};

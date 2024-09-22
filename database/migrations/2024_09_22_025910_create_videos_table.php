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
        Schema::create('videos', function (Blueprint $table) {
            $table->id(); // Tạo cột id với kiểu dữ liệu int và auto increment
            $table->string('url'); // URL của video
            $table->string('title'); // Tiêu đề của video
            $table->text('description')->nullable(); // Mô tả của video, có thể để trống
            $table->timestamps(); // Tạo cột created_at và updated_at với kiểu dữ liệu datetime
        });
    }

    /**
     * Reverse the migrations. php artisan make:migration create_quizzes_table

     */
    public function down(): void
    {
        Schema::dropIfExists('videos');
    }
};

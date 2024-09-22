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
        Schema::create('quizzes', function (Blueprint $table) {
            $table->id(); // Tạo cột id với kiểu dữ liệu int và auto increment
            $table->text('question'); // Câu hỏi của quiz
            $table->string('wrong_answer1'); // Câu trả lời sai 1
            $table->string('wrong_answer2'); // Câu trả lời sai 2
            $table->string('wrong_answer3'); // Câu trả lời sai 3
            $table->string('correct_answer'); // Câu trả lời đúng
            $table->integer('video_id'); // ID của bài học mà quiz này thuộc về
            $table->timestamps(); // Tạo cột created_at và updated_at với kiểu dữ liệu datetime
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('quizzes');
    }
};

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
        Schema::create('yeu_cau_de_tais', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id'); // Giảng viên
            $table->unsignedBigInteger('nguoi_duyet_id')->nullable(); // Người duyệt
            $table->string('ten'); // Tên đề tài
            $table->string('duong_dan_file'); // Đường dẫn file PDF
            $table->enum('trang_thai', ['cho_duyet', 'da_them'])->default('cho_duyet');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('yeu_cau_de_tais');
    }
};

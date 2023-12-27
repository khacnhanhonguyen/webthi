<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('de_thi', function (Blueprint $table) {
            $table->id();
            $table->string('tieu_de');
            $table->string('anh_de_thi')->nullable();
            // Thêm các trường khác nếu cần
            $table->date('ngay_bat_dau')->nullable();
            $table->date('ngay_ket_thuc')->nullable();
            $table->integer('thoi_gian_lam_bai')->default(2700);
            $table->boolean('mo_thi')->default(0);
            $table->text('mo_ta_cuoc_thi')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('de_thi');
    }
};

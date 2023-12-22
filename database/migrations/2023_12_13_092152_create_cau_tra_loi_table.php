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
        Schema::create('cau_tra_loi', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('cau_hoi_id');
            $table->text('noi_dung');
            $table->boolean('dung_sai');
            // Thêm các trường khác nếu cần
            $table->timestamps();

            $table->foreign('cau_hoi_id')->references('id')->on('cau_hoi')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('cau_tra_loi');
    }
};

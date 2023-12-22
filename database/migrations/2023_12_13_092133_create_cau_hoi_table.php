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
        Schema::create('cau_hoi', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('de_thi_id');
            $table->text('noi_dung');
            // Thêm các trường khác nếu cần
            $table->timestamps();

            $table->foreign('de_thi_id')->references('id')->on('de_thi')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('cau_hoi');
    }
};

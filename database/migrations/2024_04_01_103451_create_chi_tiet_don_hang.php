<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chitietdonhang', function (Blueprint $table) {
            $table->increments('chitietdonhang_id');
            $table->integer('donhang_id')->unsigned();
            $table->integer('sanpham_id')->unsigned();
            $table->integer('soluong');
            $table->decimal('gia_sp', 10, 2);
            $table->timestamps();
        
            // Thêm ràng buộc ngoại
            $table->foreign('donhang_id')->references('donhang_id')->on('don_hang');
            $table->foreign('sanpham_id')->references('sanpham_id')->on('SanPham');
        });
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('chitietdonhang');
    }
};

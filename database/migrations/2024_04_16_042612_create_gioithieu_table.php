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
        // Xóa bảng nếu tồn tại trước khi tạo lại
        Schema::dropIfExists('gioithieu');

        // Tạo lại bảng gioithieu
        Schema::create('gioithieu', function (Blueprint $table) {
            $table->id();
            $table->string('titel', 255);
            $table->string('content', 255);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Xóa bảng gioithieu nếu tồn tại
        Schema::dropIfExists('gioithieu');
    }
};


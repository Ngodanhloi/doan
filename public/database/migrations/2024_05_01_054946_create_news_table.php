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
        // Kiểm tra xem bảng news đã tồn tại hay chưa
        if (!Schema::hasTable('news')) {
            // Nếu chưa tồn tại, thì mới tạo bảng news
            Schema::create('news', function (Blueprint $table) {
                $table->id('news_id');
                $table->string('title', 255);
                $table->string('image_url', 255);
                $table->text('description');
                $table->text('content');
                $table->date('posted_date');
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Xóa bảng news nếu tồn tại
        Schema::dropIfExists('news');
    }
};


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
        Schema::create('category', function (Blueprint $table) {
            $table->increments('danhmucsp_id'); // Sử dụng increments() thay vì id() để tạo khóa chính tăng dần
            $table->string('ten', 255); // Sử dụng string() và chỉ định độ dài tối đa của chuỗi
            $table->text('mota',255); // Sử dụng text() cho mô tả vì nó có thể lưu trữ một lượng lớn dữ liệu văn bản
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
        Schema::dropIfExists('category');
    }
};

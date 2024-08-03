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
        Schema::create('chitietdonhangs', function (Blueprint $table) {
            $table->id();
            $table->integer('dongia_id');
            $table->integer('sanpham_id');
            $table->integer('soluong');
            $table->integer('gia');
            $table->integer('ghichu')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chitietdonhangs');
    }
};

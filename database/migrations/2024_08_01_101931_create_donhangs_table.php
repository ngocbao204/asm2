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
        Schema::create('donhangs', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->nullable();
            $table->integer('tinh_id')->nullable();
            $table->integer('huyen_id')->nullable();
            $table->integer('xa_id')->nullable();
            $table->string('diachi')->nullable();
            $table->text('ghichu')->nullable();
            $table->integer('giamgia')->nullable();
            $table->integer('trangthai');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('donhangs');
    }
};

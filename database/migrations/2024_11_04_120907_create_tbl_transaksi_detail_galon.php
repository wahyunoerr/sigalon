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
        Schema::create('tbl_transaksi_detail_galon', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('transaksi_id');
            $table->unsignedBigInteger('isiUlang_id');
            $table->string('subTotal', 100);
            $table->timestamps();

            $table->foreign('transaksi_id')->references('id')->on('tbl_transaksi_galon')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('isiUlang_id')->references('id')->on('tbl_isi_ulang')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_transaksi_detail_galon');
    }
};

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
            $table->unsignedBigInteger('galon_id');
            $table->unsignedBigInteger('status_id');
            $table->unsignedBigInteger('pelanggan_id');
            $table->string('jumlah', 100);
            $table->string('subTotal', 100);
            $table->timestamps();

            $table->foreign('transaksi_id')->references('id')->on('tbl_transaksi_galon')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreign('galon_id')->references('id')->on('tbl_galon')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreign('status_id')->references('id')->on('tbl_status_antar')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreign('pelanggan_id')->references('id')->on('pelanggans')->cascadeOnDelete()->cascadeOnUpdate();
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

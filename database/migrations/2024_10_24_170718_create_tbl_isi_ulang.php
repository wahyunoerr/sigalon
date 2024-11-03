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
        Schema::create('tbl_isi_ulang', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('galon_id');
            $table->unsignedBigInteger('statusAntar_id');
            $table->string('jumlah', 100);
            $table->string('alamat', 100)->nullable();
            $table->string('noHp')->nullable();
            $table->timestamps();

            $table->foreign('galon_id')->references('id')->on('tbl_galon')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('statusAntar_id')->references('id')->on('tbl_status_antar')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_isi_ulang');
    }
};

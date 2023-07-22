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
        Schema::create('transaksis', function (Blueprint $table) {
            $table->id();
            $table->string('no_transaksi');
            $table->string('no_transaksi_tmp');
            $table->string('no_meja');
            $table->string('nama_pemesan')->nullable();
            $table->string('email_pemesan')->nullable();
            $table->string('telp_pemesan')->nullable();
            $table->date('tgl_transaksi');
            $table->integer('total');
            $table->string('cara_pembayaran');
            $table->string('status_pembayaran');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('transaksi_details', function (Blueprint $table) {
            $table->id();
            $table->string('id_menu');
            $table->string('no_transaksi');
            $table->integer('qty');
            $table->integer('total');
            $table->string('notes')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksis');
    }
};

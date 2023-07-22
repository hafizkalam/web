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
        Schema::create('transaksi_tmps', function (Blueprint $table) {
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
        Schema::dropIfExists('transaksi_tmps');
    }
};

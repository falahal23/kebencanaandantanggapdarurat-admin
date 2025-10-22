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
        Schema::create('distribusi_logistik', function (Blueprint $table) {
            $table->increments('distribusi_id');
            $table->unsignedInteger('logistik_id');
            $table->unsignedInteger('posko_id');
            $table->date('tanggal');
            $table->integer('jumlah');
            $table->unsignedInteger('penerima');
            $table->timestamps();

            $table->foreign('logistik_id')->references('logistik_id')->on('logistik_bencana')->onDelete('cascade');
            $table->foreign('posko_id')->references('posko_id')->on('posko_bencana')->onDelete('cascade');
            $table->foreign('penerima')->references('warga_id')->on('warga')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('distribusi_logistik');
    }
};

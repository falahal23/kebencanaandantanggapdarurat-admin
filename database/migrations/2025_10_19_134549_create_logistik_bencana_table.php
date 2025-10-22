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
        Schema::create('logistik_bencana', function (Blueprint $table) {
            $table->increments('logistik_id');
            $table->unsignedInteger('kejadian_id');
            $table->string('nama_barang', 100);
            $table->string('satuan', 50);
            $table->integer('stok')->default(0);
            $table->string('sumber', 100)->nullable();
            $table->timestamps();

            $table->foreign('kejadian_id')->references('kejadian_id')->on('kejadian_bencana')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('logistik_bencana');
    }
};

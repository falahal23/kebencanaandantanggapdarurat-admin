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
        Schema::create('kejadian_bencana', function (Blueprint $table) {
            $table->increments('kejadian_id');
            $table->string('jenis_bencana', 100);
            $table->date('tanggal');
            $table->string('lokasi_text', 255);
            $table->string('rt', 10)->nullable();
            $table->string('rw', 10)->nullable();
            $table->text('dampak')->nullable();
            $table->string('status_kejadian', 50);
            $table->text('keterangan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kejadian_bencana');
    }
};

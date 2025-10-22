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
        Schema::create('donasi_bencana', function (Blueprint $table) {
            $table->increments('donasi_id');
            $table->unsignedInteger('kejadian_id');
            $table->string('donatur_nama', 100);
            $table->string('jenis', 100);
            $table->decimal('nilai', 15, 2)->nullable();
            $table->timestamps();

            $table->foreign('kejadian_id')->references('kejadian_id')->on('kejadian_bencana')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('donasi_bencana');
    }
};

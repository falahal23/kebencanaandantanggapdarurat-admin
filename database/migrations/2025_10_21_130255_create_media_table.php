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
        Schema::create('media', function (Blueprint $table) {
            $table->bigIncrements('media_id');
            $table->string('ref_table', 100);   // Nama tabel referensi: kejadian_bencana, posko_bencana, dll
            $table->unsignedBigInteger('ref_id'); // ID record tabel referensi
            $table->string('file_url');          // URL atau path file
            $table->string('caption')->nullable(); // Keterangan gambar/file
            $table->string('mime_type', 50);     // Jenis file (image/jpeg, pdf, dll)
            $table->integer('sort_order')->default(0); // Urutan file
            $table->timestamps(); // created_at & updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('media');
    }
};

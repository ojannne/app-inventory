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
        Schema::create('maintenance', function (Blueprint $table) {
            $table->id();
            $table->foreignId('aset_id')->constrained('asets')->onDelete('cascade');
            $table->date('tanggal_maintenance');
            $table->enum('jenis_maintenance', ['Preventive', 'Corrective', 'Emergency', 'Rutin']);
            $table->text('deskripsi');
            $table->enum('status', ['Belum Dimulai', 'Dalam Proses', 'Selesai'])->default('Belum Dimulai');
            $table->decimal('biaya', 15, 2)->nullable();
            $table->string('teknisi')->nullable();
            $table->text('catatan')->nullable();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('maintenance');
    }
};

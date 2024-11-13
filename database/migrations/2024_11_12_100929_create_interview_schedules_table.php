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
        Schema::create('interview_schedules', function (Blueprint $table) {
            $table->id(); // Auto-incrementing ID
            $table->uuid('uuid'); // UUID untuk keunikan
            $table->foreignId('application_id')->constrained('applications')->onDelete('cascade'); // Foreign key ke tabel applications
            $table->dateTime('interview_date'); // Tanggal dan waktu interview
            $table->enum('interview_method', ['online', 'offline'])->default('offline'); // Metode interview
            $table->string('interview_location')->nullable(); // Lokasi interview (opsional)
            $table->string('interviewer_name'); // Nama pewawancara
            $table->text('notes')->nullable(); // Catatan tambahan (opsional)
            $table->enum('status', ['scheduled', 'completed', 'cancelled'])->default('scheduled'); // Status jadwal interview
            $table->timestamps(); // created_at dan updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('interview_schedules');
    }
};

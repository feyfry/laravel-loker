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
        Schema::create('job_descs', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid');
            $table->foreignId('posted_by')->constrained('users');
            $table->string('title');
            $table->text('description');
            $table->text('requirements');
            $table->string('salary_range');
            $table->string('location');
            $table->enum('status', ['open', 'closed'])->default('open');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('job_descs');
    }
};

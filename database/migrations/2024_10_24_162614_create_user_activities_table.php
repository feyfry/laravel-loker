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
        Schema::create('user_activities', function (Blueprint $table) {
            $table->id();
            $table->string('ip_address')->nullable();
            $table->json('location')->nullable();
            $table->json('browser')->nullable();
            $table->text('user_agent')->nullable();
            $table->timestamp('last_activity')->nullable();
            $table->text('last_page')->nullable();
            $table->text('referrer')->nullable();
            $table->string('session_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_activities');
    }
};

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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('tel');
            $table->string('img')->nullable();
            $table->string('birth')->nullable();
            $table->string('gender')->nullable();
            $table->string('country')->nullable();
            $table->string('prefecture')->nullable();
            $table->string('city')->nullable();
            $table->string('job')->nullable();
            $table->string('marital')->nullable();
            $table->string('children')->nullable();
            $table->string('salary')->nullable();
            $table->string('business')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};

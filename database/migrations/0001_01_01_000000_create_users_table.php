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
            $table->string('username')->unique()->index();
            $table->string('name')->nullable(false);
            $table->string('lastname')->nullable(false);
            $table->string('phone')->nullable(false)->unique();
            $table->jsonb('emails')->nullable(false); // $table->string('email')->unique(); // $table->timestamp('email_verified_at')->nullable();
            $table->jsonb('extras');
            $table->timestamp('user_verified_at')->nullable(true);
            $table->timestamp('user_last_access')->nullable(true);
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });

        // not needed for now
        // Schema::create('password_reset_tokens', function (Blueprint $table) {
        //     $table->string('email')->primary();
        //     $table->string('token');
        //     $table->timestamps();
        // });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens'); // safe call
        Schema::dropIfExists('sessions');
    }
};

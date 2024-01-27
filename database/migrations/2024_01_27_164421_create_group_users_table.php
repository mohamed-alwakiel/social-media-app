<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('group_users', function (Blueprint $table) {
            $table->id();
            $table->foreignId('group_id')->constrained('groups');
            $table->foreignId('user_id')->constrained('users');
            $table->string('role', 25); // admin - user
            $table->string('status', 25); // approved - pending
            $table->foreignId('created_by_id')->constrained('users');
            $table->string('token', 1024)->nullable(); // for invitation
            $table->timestamp('token_expire_date')->nullable();
            $table->timestamp('token_used')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('group_users');
    }
};

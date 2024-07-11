<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('user_activity_logs', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->timestampTz('at');
            $table->uuid('user_id')->nullable();
            $table->string('title');
            $table->text('link')->nullable();
            $table->text('message')->nullable();
            $table->ipAddress('i_p_address')->nullable();

            $table->index('user_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_activity_logs');
    }
};

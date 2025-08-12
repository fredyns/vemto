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
        Schema::create('subrecords', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('record_id');
            $table->dateTime('datetime')->nullable();
            $table->date('date')->nullable();
            $table->time('time')->nullable();
            $table->bigInteger('n_p_w_p')->nullable();
            $table->text('markdown_text')->nullable();
            $table->text('w_y_s_i_w_y_g')->nullable();
            $table->text('file')->nullable();
            $table->text('image')->nullable();
            $table->ipAddress('i_p_address')->nullable();
            $table->float('latitude')->nullable();
            $table->float('longitude')->nullable();

            $table->index('record_id');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subrecords');
    }
};

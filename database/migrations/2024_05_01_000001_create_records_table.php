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
        Schema::create('records', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('created_by')->nullable();
            $table->uuid('updated_by')->nullable();
            $table->uuid('user_id')->nullable();
            $table->string('string');
            $table->string('email')->nullable();
            $table->integer('integer')->nullable();
            $table->decimal('decimal')->nullable();
            $table->bigInteger('n_p_w_p')->nullable();
            $table->dateTime('datetime')->nullable();
            $table->date('date')->nullable();
            $table->time('time')->nullable();
            $table->ipAddress('i_p_address')->nullable();
            $table->boolean('bool')->nullable();
            $table->enum('enum', ['enabled', 'disabled'])->nullable();
            $table->text('text')->nullable();
            $table->text('file')->nullable();
            $table->text('image')->nullable();
            $table->text('markdown_text')->nullable();
            $table->text('w_y_s_i_w_y_g')->nullable();
            $table->float('latitude')->nullable();
            $table->float('longitude')->nullable();

            $table->index('user_id');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('records');
    }
};

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
        Schema::table('subrecords', function (Blueprint $table) {
            $table
                ->foreign('record_id')
                ->references('id')
                ->on('records')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('subrecords', function (Blueprint $table) {
            $table->dropForeign(['record_id']);
        });
    }
};

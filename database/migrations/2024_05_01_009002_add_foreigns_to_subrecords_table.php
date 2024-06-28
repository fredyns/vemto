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
        Schema::table('subrecords', function (Blueprint $table) {
            $table
                ->foreignUuid('record_id')
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

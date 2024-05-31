<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::table('users')->insert([
            [
                'id' => 'f12ed100-5a1e-35f7-ba2e-253ae79d696b',
                'name' => 'Fredy',
                'email' => 'fredy.ns@gmail.com',
                'password' => '$2y$10$MzUsuh0fQuLw2TRgdaeFhug2jsT9egIMg8ze3lUKjy/8E1N5POx..',
                'email_verified_at' => now(),
                'remember_token' => Str::random(10),
            ],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};

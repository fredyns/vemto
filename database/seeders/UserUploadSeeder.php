<?php

namespace Database\Seeders;

use App\Models\UserUpload;
use Illuminate\Database\Seeder;

class UserUploadSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        UserUpload::factory()
            ->count(5)
            ->create();
    }
}

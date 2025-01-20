<?php

namespace Database\Seeders;

use App\Models\UserActivityLog;
use Illuminate\Database\Seeder;

class UserActivityLogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        UserActivityLog::factory()
            ->count(5)
            ->create();
    }
}

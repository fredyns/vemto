<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\UserActivityLog;

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

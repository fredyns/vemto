<?php

namespace Database\Seeders;

use App\Models\Subrecord;
use Illuminate\Database\Seeder;

class SubrecordSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Subrecord::factory()
            ->count(5)
            ->create();
    }
}

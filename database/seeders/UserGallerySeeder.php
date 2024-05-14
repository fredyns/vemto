<?php

namespace Database\Seeders;

use App\Models\UserGallery;
use Illuminate\Database\Seeder;

class UserGallerySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        UserGallery::factory()
            ->count(5)
            ->create();
    }
}

<?php

namespace Database\Seeders;

use App\Models\User;
use Hash;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Adding an admin user
        $user = User::factory()
            ->count(1)
            ->create([
                'email' => 'admin@admin.com',
                'password' => Hash::make('admin'),
            ]);
        $this->call(PermissionsSeeder::class);

        $this->call(UserSeeder::class);
        $this->call(UserActivityLogSeeder::class);
        $this->call(UserGallerySeeder::class);
        $this->call(UserUploadSeeder::class);

        $this->call(RecordSeeder::class);
        $this->call(SubrecordSeeder::class);
    }
}

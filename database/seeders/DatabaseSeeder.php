<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Run individual seeders
        $this->call([
            SekolahSeeder::class,
            UserSeeder::class
        ]);
    }
}

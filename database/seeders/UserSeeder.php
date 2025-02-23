<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Sekolah;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Faker\Factory as Faker;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create();

        // Create Superadmin
        User::create([
            'name' => 'Superadmin',
            'email' => 'superadmin@example.com',
            'password' => Hash::make('password'),
            'role' => 'superadmin',
            'sekolah_id' => null, // Superadmin is not linked to a school
        ]);

        // Create Guest
        User::create([
            'name' => 'Guest',
            'email' => 'guest@example.com',
            'password' => Hash::make('password'),
            'role' => 'guest',
            'sekolah_id' => null, // Guest is also not linked to a school
        ]);

        // Create Admin for each Sekolah
        $sekolahs = Sekolah::all(); // Get all schools
        $schoolCounts = []; // Track school occurrences

        foreach ($sekolahs as $sekolah) {
            $schoolName = trim($sekolah->nama_sekolah); // Trim spaces
            $normalizedSchoolName = strtolower(str_replace('-', '', $schoolName)); // Normalize case + remove hyphens

            // Check if this school name has already been used
            if (!isset($schoolCounts[$normalizedSchoolName])) {
                // First occurrence → No number
                $email = 'admin@' . Str::slug($schoolName, '') . '.com';
                $schoolCounts[$normalizedSchoolName] = 1; // Set counter
            } else {
                // Second+ occurrence → Add number suffix
                $schoolCounts[$normalizedSchoolName]++;
                $email = 'admin' . $schoolCounts[$normalizedSchoolName] . '@' . Str::slug($schoolName, '') . '.com';
            }

            // Generate an admin name
            $adminName = $faker->firstName() . ' - ' . $schoolName;

            // Create User with assigned sekolah_id
            User::create([
                'name' => $adminName,
                'email' => $email,
                'password' => Hash::make('password'),
                'role' => 'admin_sekolah',
                'sekolah_id' => $sekolah->id, // Ensure admin is linked to a school
            ]);
        }
    }
}

<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UpdateUserProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Update the first user to have a more complete profile
        $user = User::first();

        if ($user) {
            $user->update([
                'name' => 'Admin User',
                'email' => 'admin@codesprintx.com'
            ]);

            echo "Updated admin user profile\n";
        }

        // Create additional admin user if needed
        if (User::count() < 2) {
            User::create([
                'name' => 'Super Admin',
                'email' => 'superadmin@codesprintx.com',
                'password' => bcrypt('password123'),
                'email_verified_at' => now(),
            ]);

            echo "Created additional admin user\n";
        }
    }
}

<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class superAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'first_name' => "Super",
            'last_name' => "Admin",
            'email' => "admin@gmail.com",
            'password' => Hash::make('12345678'),
            'is_role' => "superadmin",
            'mobile_number' => "7610604872",
            'address' => "Balaghat",
            'is_active' => true,
            'terms_and_conditions' => true,
        ]);
    }
}

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
            'name' => "Nita Bopche",
            'email' => "codeesprintx@gmail.com",
            'password' => Hash::make('password'),
            'is_role' => "superadmin",
            'mobile_number' => "7610604872",
            'address' => "Balaghat"
        ]);
    }
}

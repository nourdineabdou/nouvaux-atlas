<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create or update admin user
        $email = 'mouhamedlamine@gmail.com';
        $data = [
            'name' => 'Mouhamed Lamine',
            'email' => $email,
            'password' => Hash::make('password'),
        ];

        User::updateOrCreate(['email' => $email], $data);
    }
}

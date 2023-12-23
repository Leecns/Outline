<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        if (! User::whereUsername('admin')->exists()) {
            User::create([
                'name' => 'Administrator',
                'username' => 'admin',
                'password' => Hash::make(config('app.admin_password'))
            ]);
        }
    }
}

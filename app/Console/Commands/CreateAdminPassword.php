<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class CreateAdminPassword extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'admin:make';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create the "admin" user';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        if (User::whereUsername('admin')->exists()) {
            $this->error('Admin user already exists.');
            return;
        }

        $password = $this->secret('Enter password');
        $confirmPassword = $this->secret('Confirm password');

        if ($password !== $confirmPassword) {
            $this->error('Passwords do not match. Please try again.');
            return;
        }

        User::create([
            'username' => 'admin',
            'name' => 'Administrator',
            'password' => Hash::make($password),
        ]);

        $this->info('Admin user has been created successfully.');
    }
}

<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class UpdateAdminPassword extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'admin:password';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Reset the "admin" user password';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $newPassword = $this->secret('Enter new password');
        $confirmPassword = $this->secret('Confirm new password');

        if ($newPassword !== $confirmPassword) {
            $this->error('Passwords do not match. Please try again.');

            return;
        }

        User::whereUsername('admin')->update([
            'password' => Hash::make($newPassword),
        ]);

        $this->info('Admin password has been updated successfully.');
    }
}

<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Seed the default admin user from environment variables.
     */
    public function run(): void
    {
        $email = config('admin.seed.email');
        $password = config('admin.seed.password');
        $name = config('admin.seed.name');

        if (! is_string($email) || $email === '' || ! is_string($password) || $password === '') {
            $this->command->warn('Admin seed skipped: set SEED_ADMIN_EMAIL and SEED_ADMIN_PASSWORD in .env');

            return;
        }

        $name = is_string($name) && $name !== '' ? $name : 'Site Admin';

        User::query()->updateOrCreate(
            ['email' => $email],
            [
                'name' => $name,
                'password' => $password,
                'is_admin' => true,
                'email_verified_at' => now(),
            ],
        );

        $this->command->info("Admin user seeded: {$email}");
    }
}

<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // create an admin account
        User::factory()->create([
            'name' => 'Administrator',
            'email' => 'admin@admin.com',
            'is_admin' => 1,
        ]);

        // general user account
        User::factory(10)->create();
    }
}

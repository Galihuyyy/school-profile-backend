<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\UserPermission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::create([
            'name' => 'Superadmin',
            'username' => 'superadmin',
            'email' => 'superadmin@mail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
        ]);
        
        $permissions = [
            'school_info',
            'manage_teacher',
            'manage_admin',
            'manage_post',
            'manage_job',
            'manage_department',
        ];

        foreach ($permissions as $slug) {
            UserPermission::create([
                'user_id' => $user->id,
                'slug'    => $slug,
            ]);
        }
    }
}

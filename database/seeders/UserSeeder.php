<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
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
            'email_verified_at' => Carbon::now(),
            'password' => Hash::make('password'),
        ]);

        foreach (config('userPermission') as $item) {
            $user->user_permission()->create([
                'slug' => $item['id']
            ]);
        }
    }
}

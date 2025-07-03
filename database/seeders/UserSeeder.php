<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Buat role jika belum ada
        $roles = ['admin', 'karyawan'];
        foreach ($roles as $role) {
            Role::firstOrCreate(['name' => $role]);
        }

        // Data user
        $users = [
            [
                'name' => 'admin',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('admin123'),
                'role' => 'admin',
            ],
            [
                'name' => 'karyawan',
                'email' => 'karyawan@gmail.com',
                'password' => Hash::make('karyawan123'),
                'role' => 'karyawan',
            ],
        ];

        // Buat user dan assign role
        foreach ($users as $userData) {
            $user = User::firstOrCreate(
                ['email' => $userData['email']],
                [
                    'name' => $userData['name'],
                    'password' => $userData['password'],
                ]
            );

            $user->assignRole($userData['role']);
        }
    }
}

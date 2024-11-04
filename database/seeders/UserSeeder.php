<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        $user = [
            'admin' => [
                'name' => 'admin',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('admin123')
            ],
            'karyawan' => [
                'name' => 'karyawan',
                'email' => 'karyawan@gmail.com',
                'password' => Hash::make('karyawan123')
            ]
        ];

        foreach ($user as $ur => $userRole) {
            $createUser = User::create($userRole);

            if ($ur === 'admin') {
                $createUser->assignRole(Role::where('name', 'admin')->first());
            }

            if ($ur === 'karyawan') {
                $createUser->assignRole(Role::where('name', 'karyawan')->first());
            }
        }
    }
}

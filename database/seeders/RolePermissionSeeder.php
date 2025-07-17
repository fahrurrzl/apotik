<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roleOwner = Role::create(['name' => 'owner']);
        $roleBuyer = Role::create(['name' => 'buyer']);

        $user = User::create([
            'name' => 'Fahrur Owner',
            'email' => 'fahrur@mail.com',
            'password' => bcrypt('password')
        ]);

        $user->assignRole($roleOwner);
    }
}

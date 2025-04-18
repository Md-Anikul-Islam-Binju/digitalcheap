<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class CreateAdminUserSeeder extends Seeder
{

    public function run(): void
    {
        $user = User::create([
            'name' => 'Sorobonno Super Admin',
            'email' => 'sorobonno@admin.com',
            'is_registration_by' => 'Super Admin',
            'email_verified_at' => now(),
            'password' => bcrypt('sorobonno@2025'),
            'status' => 1,
        ]);
        $role = Role::create(['name' => 'Super Admin']);
        $permissions = Permission::pluck('id','id')->all();
        $role->syncPermissions($permissions);
        $user->assignRole([$role->id]);
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionTableSeeder extends Seeder
{
    public function run(): void
    {
        $permissions = [

            //roll and permission
            'role-and-permission-list',
            'role-list',
            'role-create',
            'role-edit',
            'role-delete',

            //Panel Basic
            'basic-menu-list',

            //For User
            'user-list',
            'user-create',
            'user-edit',
            'user-delete',

            //For About
            'about-list',
            'about-create',
            'about-edit',
            'about-delete',

            //For Slider
            'slider-list',
            'slider-create',
            'slider-edit',
            'slider-delete',


            //Site Setting
            'site-setting',

            //Dashboard
            'cart-list',
            'login-log-list',
        ];
        foreach ($permissions as $permission) {
            if (!Permission::where('name', $permission)->exists()) {
                Permission::create(['name' => $permission]);
            }
        }
    }
}

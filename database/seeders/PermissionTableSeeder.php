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

            //For Coupon
            'coupon-list',
            'coupon-create',
            'coupon-edit',
            'coupon-delete',

            //For Category
            'category-list',
            'category-create',
            'category-edit',
            'category-delete',

            //For Currency
            'currency-list',
            'currency-create',
            'currency-edit',
            'currency-delete',

            //For Faq
            'faq-list',
            'faq-create',
            'faq-edit',
            'faq-delete',

            //For Slider
            'slider-list',
            'slider-create',
            'slider-edit',
            'slider-delete',

            //For service
            'service-list',
            'service-create',
            'service-edit',
            'service-delete',

            //For product
            'product-list',
            'product-create',
            'product-edit',
            'product-delete',


            //For package
            'package-list',
            'package-create',
            'package-edit',
            'package-delete',


            //Site Setting
            'site-setting',
            'terms-and-condition-list',

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

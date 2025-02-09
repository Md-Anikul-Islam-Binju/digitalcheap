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


            //Manage Product
            'manage-product-section',
            'settings-on-site',

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

            //For Partner
            'partner-list',
            'partner-create',
            'partner-edit',
            'partner-delete',

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


            //For Blog
            'blog-list',
            'blog-create',
            'blog-edit',
            'blog-delete',

            //For Review
            'review-list',
            'review-create',
            'review-edit',
            'review-delete',


            //Site Setting
            'site-setting',
            'terms-and-condition-list',

            //Dashboard
            'cart-list',
            'login-log-list',
            'live-chat',

            //For Order
            'order-manage',
            'order-list',
            'order-today',
            'order-monthly',
            'order-yearly',
            'user-order-list',

            //account-setting
            'account-setting',
            'my-affiliate',


            //For User
            'user-manage',
            'active-user-list',
            'inactive-user-list',

        ];
        foreach ($permissions as $permission) {
            if (!Permission::where('name', $permission)->exists()) {
                Permission::create(['name' => $permission]);
            }
        }
    }
}

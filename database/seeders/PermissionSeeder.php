<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('permissions')->insert([
            /*
            |--------------------------------------------------------------------------
            | Content
            |--------------------------------------------------------------------------
            |
            |
            |
            |
            |
            */

            //post category
            [
                'name' => 'PostCategory:create',
            ],
            [
                'name' => 'show post category',
            ],
            [
                'name' => 'update post category',
            ],
            [
                'name' => 'delete post category',
            ],

            //post comment
            [
                'name' => 'show post comment',
            ],
            [
                'name' => 'delete post comment',
            ],
            [
                'name' => 'change approve post comment',
            ],
            [
                'name' => 'change status post comment',
            ],

            //faq
            [
                'name' => 'create faq',
            ],
            [
                'name' => 'show faq',
            ],
            [
                'name' => 'update faq',
            ],
            [
                'name' => 'delete faq',
            ],

            //menu
            [
                'name' => 'create menu',
            ],
            [
                'name' => 'show menu',
            ],
            [
                'name' => 'update menu',
            ],
            [
                'name' => 'delete menu',
            ],

            //page
            [
                'name' => 'create page',
            ],
            [
                'name' => 'show page',
            ],
            [
                'name' => 'update page',
            ],
            [
                'name' => 'delete page',
            ],

            //post
            [
                'name' => 'create post',
            ],
            [
                'name' => 'show post',
            ],
            [
                'name' => 'update post',
            ],
            [
                'name' => 'delete post',
            ],

            /*
            |--------------------------------------------------------------------------
            | User
            |--------------------------------------------------------------------------
            |
            |
            |
            |
            |
            */

            //admin-user
            [
                'name' => 'create admin user',
            ],
            [
                'name' => 'show admin user',
            ],
            [
                'name' => 'update admin user',
            ],
            [
                'name' => 'delete admin user',
            ],

            //customer
            [
                'name' => 'create customer',
            ],
            [
                'name' => 'show customer',
            ],
            [
                'name' => 'update customer',
            ],
            [
                'name' => 'delete customer',
            ],

            //role
            [
                'name' => 'create role',
            ],
            [
                'name' => 'show role',
            ],
            [
                'name' => 'update role',
            ],
            [
                'name' => 'delete role',
            ],

            //permission
            [
                'name' => 'show permission',
            ],

            /*
            |--------------------------------------------------------------------------
            | Notify
            |--------------------------------------------------------------------------
            |
            |
            |
            |
            |
            */

            //email
            [
                'name' => 'create email',
            ],
            [
                'name' => 'show email',
            ],
            [
                'name' => 'update email',
            ],
            [
                'name' => 'delete email',
            ],

            //sms
            [
                'name' => 'create sms',
            ],
            [
                'name' => 'show sms',
            ],
            [
                'name' => 'update sms',
            ],
            [
                'name' => 'delete sms',
            ],

            /*
            |--------------------------------------------------------------------------
            | Ticket
            |--------------------------------------------------------------------------
            |
            |
            |
            |
            |
            */

            //ticket category
            [
                'name' => 'create ticket category',
            ],
            [
                'name' => 'show ticket category',
            ],
            [
                'name' => 'update ticket category',
            ],
            [
                'name' => 'delete ticket category',
            ],

            //ticket priority
            [
                'name' => 'create ticket priority',
            ],
            [
                'name' => 'show ticket priority',
            ],
            [
                'name' => 'update ticket priority',
            ],
            [
                'name' => 'delete ticket priority',
            ],

            //ticket admin
            [
                'name' => 'show ticket admin',
            ],
            [
                'name' => 'toggle ticket priority',
            ],

            //ticket
            [
                'name' => 'show ticket',
            ],
            [
                'name' => 'answer ticket',
            ],
            [
                'name' => 'change ticket status',
            ],

            /*
            |--------------------------------------------------------------------------
            | Setting
            |--------------------------------------------------------------------------
            |
            |
            |
            |
            |
            */

            //setting
            [
                'name' => 'show setting',
            ],
            [
                'name' => 'update setting',
            ],

            /*
            |--------------------------------------------------------------------------
            | Market
            |--------------------------------------------------------------------------
            |
            |
            |
            |
            |
            */

            //product category
            [
                'name' => 'create product category',
            ],
            [
                'name' => 'show product category',
            ],
            [
                'name' => 'update product category',
            ],
            [
                'name' => 'delete product category',
            ],

            //brand
            [
                'name' => 'create brand',
            ],
            [
                'name' => 'show brand',
            ],
            [
                'name' => 'update brand',
            ],
            [
                'name' => 'delete brand',
            ],

            //product comment
            [
                'name' => 'show product comment',
            ],
            [
                'name' => 'change approve product comment',
            ],
            [
                'name' => 'change status product comment',
            ],
            [
                'name' => 'delete product comment',
            ],

            //delivery
            [
                'name' => 'create delivery',
            ],
            [
                'name' => 'show delivery',
            ],
            [
                'name' => 'update delivery',
            ],
            [
                'name' => 'delete delivery',
            ],

            //product
            [
                'name' => 'create product',
            ],
            [
                'name' => 'show product',
            ],
            [
                'name' => 'update product',
            ],
            [
                'name' => 'delete product',
            ],

            //product gallery
            [
                'name' => 'create product gallery',
            ],
            [
                'name' => 'show product gallery',
            ],
            [
                'name' => 'delete product gallery',
            ],

            //product color
            [
                'name' => 'create product color',
            ],
            [
                'name' => 'show product color',
            ],
            [
                'name' => 'delete product color',
            ],

            //category attribute
            [
                'name' => 'create category attribute',
            ],
            [
                'name' => 'show category attribute',
            ],
            [
                'name' => 'update category attribute',
            ],
            [
                'name' => 'delete category attribute',
            ],

            //category attribute value
            [
                'name' => 'create category attribute value',
            ],
            [
                'name' => 'show category attribute value',
            ],
            [
                'name' => 'update category attribute value',
            ],
            [
                'name' => 'delete category attribute value',
            ],

            //storage
            [
                'name' => 'add to storage storage',
            ],
            [
                'name' => 'update storage',
            ],

        ]);
    }
}

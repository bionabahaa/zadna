<?php

use Illuminate\Database\Seeder;

class RolePermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Permissions
        DB::table('permission')->insert([
            'id' => 1,
            'title' => 'إضافه',
        ]);
        DB::table('permission')->insert([
            'id' => 2,
            'title' => 'تعديل',
        ]);
        DB::table('permission')->insert([
            'id' => 3,
            'title' => 'مشاهده',
        ]);
        DB::table('permission')->insert([
            'id' => 4,
            'title' => 'دخول',
        ]);
        // Set Administrator Role
        DB::table('role')->insert([
            'id' => 1,
            'code' => 1000,
            'title' => 'أدمن رئيسى',
        ]);
        DB::table('role')->insert([
            'id' => 2,
            'code' => 1001,
            'title' => 'أستشارى',
        ]);
        
        // Set Administrator Users

        DB::table('users')->insert([
            'id' => 1,
            'role_id' => 1,
            'username' => 'Admin',
            'password' => bcrypt('123123'),
            'email' => 'admin@admin.com',
        ]);

        DB::table('moduels_type')->insert([
            'id' => 1,
            'code'=>'10',
            'title' => '  خامه اساسيه',
            'moduel_id' => 7,
        ]);

        DB::table('moduels_type')->insert([
            'id' => 2,
            'code'=>'11',
            'title' => 'خامه  مساعده ',
            'moduel_id' => 7,
        ]);
    }
}

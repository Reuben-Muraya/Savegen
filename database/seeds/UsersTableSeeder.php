<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'role_id' => '1',
            'first_name' => 'Reuben',
            'last_name' => 'Muraya',
            'phone_no' => '0711287495',
            'id_number' => '11111111',
            'email' => 'reuben@admin.com',
            'password' => bcrypt('rootadmin'),
        ]);

        DB::table('users')->insert([
            'role_id' => '2',
            'first_name' => 'Reuben',
            'last_name' => 'Ubby',
            'phone_no' => '0711287495',
            'id_number' => '22222222',
            'email' => 'reuben@ubby.com',
            'password' => bcrypt('rootuser'),
        ]);
    }
}

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
            'username' => 'Reuben Muraya',
            'email' => 'reuben@admin.com',
            'password' => bcrypt('rootadmin'),
        ]);

        DB::table('users')->insert([
            'role_id' => '2',
            'username' => 'Reuben Ubby',
            'email' => 'reuben@ubby.com',
            'password' => bcrypt('rootauthor'),
        ]);
    }
}

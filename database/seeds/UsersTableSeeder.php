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
        $id = DB::table('users')->insertGetId([
            'email' => 'admin@admin.com',
            'nom' => 'admin',
            'tel' => '06999999',
            'numero' => 'ddd',
            'cin' => 'ddddd',
            'address' => 'ddddd',
            'password' => bcrypt('000000'),
        ]);

        DB::table('user_details')->insert([
            'user_id' => $id
        ]);

        $id1 = DB::table('users')->insertGetId([
            'email' => 'user@user.com',
            'nom' => 'user',
            'tel' => '06999999',
            'numero' => 'ddd',
            'cin' => 'ddddd',
            'address' => 'ddddd',
            'password' => bcrypt('000000'),
        ]);

        DB::table('user_details')->insert([
            'user_id' => $id1
        ]);
    }
}

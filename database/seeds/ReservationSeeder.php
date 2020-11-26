<?php

use Illuminate\Database\Seeder;

class ReservationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $id = DB::table('reservations')->insertGetId([
            'id_Etat' => 1,
            'id_User' => 1,
            'date_etat' => new \DateTime(),
        ]);

        $id = DB::table('reservations')->insertGetId([
            'id_Etat' => 1,
            'id_User' => 2,
            'date_etat' => new \DateTime(),
        ]);
    }
}

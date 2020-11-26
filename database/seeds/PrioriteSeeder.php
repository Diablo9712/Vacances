<?php

use Illuminate\Database\Seeder;

class PrioriteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $id = DB::table('priorites')->insertGetId([
            'id_Ville' => 1,
            'id_Reservation' => 1,
            'classement' => 1,
            'date_debut' => date_create_from_format("Y-m-d", "2020-5-1"),
            'date_fin' => date_create_from_format("Y-m-d", "2020-5-15")
        ]);


        $id = DB::table('priorites')->insertGetId([
            'id_Ville' => 1,
            'id_Reservation' => 2,
            'classement' => 1,
            'date_debut' => date_create_from_format("Y-m-d", "2020-5-21"),
            'date_fin' => date_create_from_format("Y-m-d", "2020-5-27")
        ]);

        // centre 2
        $id = DB::table('priorites')->insertGetId([
            'id_Ville' => 1,
            'id_Reservation' => 1,
            'classement' => 1,
            'date_debut' => date_create_from_format("Y-m-d", "2020-5-9"),
            'date_fin' => date_create_from_format("Y-m-d", "2020-5-15")
        ]);
        $id = DB::table('priorites')->insertGetId([
            'id_Ville' => 1,
            'id_Reservation' => 2,
            'classement' => 1,
            'date_debut' => date_create_from_format("Y-m-d", "2020-5-17"),
            'date_fin' => date_create_from_format("Y-m-d", "2020-5-24")
        ]);

        /// centre 3
        $id = DB::table('priorites')->insertGetId([
            'id_Ville' => 1,
            'id_Reservation' => 1,
            'classement' => 3,
            'date_debut' => date_create_from_format("Y-m-d", "2020-5-10"),
            'date_fin' => date_create_from_format("Y-m-d", "2020-5-20")
        ]);
        $id = DB::table('priorites')->insertGetId([
            'id_Ville' => 1,
            'id_Reservation' => 2,
            'classement' => 4,
            'date_debut' => date_create_from_format("Y-m-d", "2020-5-23"),
            'date_fin' => date_create_from_format("Y-m-d", "2020-5-30")
        ]);


        // centre 4
        $id = DB::table('priorites')->insertGetId([
            'id_Ville' => 1,
            'id_Reservation' => 1,
            'classement' => 3,
            'date_debut' => date_create_from_format("Y-m-d", "2020-5-14"),
            'date_fin' => date_create_from_format("Y-m-d", "2020-5-24")
        ]);
    }
}

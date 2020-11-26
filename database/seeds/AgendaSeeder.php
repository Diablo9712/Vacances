<?php

use Illuminate\Database\Seeder;

class AgendaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $id = DB::table('agendas')->insertGetId([
            'id_centre' => 1,
            'id_priorite' => 1,
//             'id_etat_centre' => 1,
            'montant_reservation' => 100,
            'montant_penalite' => 100
        ]);

        $id = DB::table('agendas')->insertGetId([
            'id_centre' => 1,
            'id_priorite' => 2,
            // 'id_etat_centre' => 1,
            'montant_reservation' => 100,
            'montant_penalite' => 100
        ]);

        $id = DB::table('agendas')->insertGetId([
            'id_centre' => 2,
            'id_priorite' => 3,
            // 'id_etat_centre' => 1,
            'montant_reservation' => 100,
            'montant_penalite' => 100
        ]);

        $id = DB::table('agendas')->insertGetId([
            'id_centre' => 2,
            'id_priorite' => 4,
            // 'id_etat_centre' => 1,
            'montant_reservation' => 100,
            'montant_penalite' => 100
        ]);

        $id = DB::table('agendas')->insertGetId([
            'id_centre' => 3,
            'id_priorite' => 5,
            // 'id_etat_centre' => 1,
            'montant_reservation' => 100,
            'montant_penalite' => 100
        ]);

        $id = DB::table('agendas')->insertGetId([
            'id_centre' => 3,
            'id_priorite' => 6,
            // 'id_etat_centre' => 1,
            'montant_reservation' => 100,
            'montant_penalite' => 100
        ]);

        $id = DB::table('agendas')->insertGetId([
            'id_centre' => 4,
            'id_priorite' => 7,
            // 'id_etat_centre' => 1,
            'montant_reservation' => 100,
            'montant_penalite' => 100
        ]);
    }
}

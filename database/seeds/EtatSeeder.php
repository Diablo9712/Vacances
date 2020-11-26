<?php

use Illuminate\Database\Seeder;

class EtatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $id = DB::table('etat_reservation')->insertGetId([
            'libelle' => 'En attente'
        ]);
        $id = DB::table('etat_reservation')->insertGetId([
            'libelle' => 'Anulle'
        ]);
        $id = DB::table('etat_reservation')->insertGetId([
            'libelle' => 'Valide'
        ]);
        $id = DB::table('etat_reservation')->insertGetId([
            'libelle' => 'Rejete'
        ]);
    }
}

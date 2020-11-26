<?php

use Illuminate\Database\Seeder;

class EtatCentreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $id = DB::table('etat_centres')->insertGetId([
            'libelle' => "Occupe",
        ]);
        $id = DB::table('etat_centres')->insertGetId([
            'libelle' => "Disponible",
        ]);
    }
}

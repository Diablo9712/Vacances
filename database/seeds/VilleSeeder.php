<?php

use Illuminate\Database\Seeder;

class VilleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $id = DB::table('villes')->insertGetId([
            'libelle' => 'Oujda'
        ]);
        $id = DB::table('villes')->insertGetId([
            'libelle' => 'Saidia'
        ]);
        $id = DB::table('villes')->insertGetId([
            'libelle' => 'Rabat'
        ]);
        $id = DB::table('villes')->insertGetId([
            'libelle' => 'Dakhla'
        ]);
        $id = DB::table('villes')->insertGetId([
            'libelle' => 'Tanger'
        ]);
        $id = DB::table('villes')->insertGetId([
            'libelle' => 'Tetouan'
        ]);
    }
}

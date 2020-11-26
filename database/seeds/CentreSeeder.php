<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CentreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $id = DB::table('centres')->insertGetId([
            'ville_id' => 1,
            'libelle' => 'Centre 1'
        ]);
        $id = DB::table('centres')->insertGetId([
            'ville_id' => 1,
            'libelle' => 'Centre 2'
        ]);
        $id = DB::table('centres')->insertGetId([
            'ville_id' => 1,
            'libelle' => 'Centre 3'
        ]);
        $id = DB::table('centres')->insertGetId([
            'ville_id' => 1,
            'libelle' => 'Centre 4'
        ]);
    }
}

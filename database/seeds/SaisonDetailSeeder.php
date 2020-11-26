<?php

use Illuminate\Database\Seeder;

class SaisonDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('saison_details')->insertGetId([
            'label' => 'Haute Saison',
        ]);
        DB::table('saison_details')->insertGetId([
            'label' => 'Basse Saison',
        ]);
    }
}

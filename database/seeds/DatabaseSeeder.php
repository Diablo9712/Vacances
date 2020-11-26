<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         $this->call(UsersTableSeeder::class);
         $this->call(EtatSeeder::class);
         $this->call(VilleSeeder::class);
         $this->call(CentreSeeder::class);
         $this->call(ReservationSeeder::class);
         $this->call(PrioriteSeeder::class);
         $this->call(EtatCentreSeeder::class);
         $this->call(AgendaSeeder::class);
         $this->call(SaisonDetailSeeder::class);
    }
}

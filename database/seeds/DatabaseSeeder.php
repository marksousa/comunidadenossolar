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
        $this->call(PapelSeeder::class);
        $this->call(PermissaoSeeder::class);
        $this->call(PaisSeeder::class);
        $this->call(EstadoSeeder::class);
        $this->call(GeneroSeeder::class);
        $this->call(MotivoSeeder::class);
        $this->call(PilarSeeder::class);
    }
}

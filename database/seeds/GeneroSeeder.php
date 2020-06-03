<?php

use Illuminate\Database\Seeder;
use App\Genero;

class GeneroSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $p1 = Genero::firstOrCreate([
            'nome' =>'Feminino'
        ]);

        $p2 = Genero::firstOrCreate([
            'nome' =>'Masculino'
        ]);

        $p3 = Genero::firstOrCreate([
            'nome' =>'Outros'
        ]);

        $p4 = Genero::firstOrCreate([
            'nome' =>'Prefere não responder'
        ]);

    }
}

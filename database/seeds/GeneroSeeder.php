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
            'nome' =>'Masculino'
        ]);

        $p2 = Genero::firstOrCreate([
            'nome' =>'Feminino'
        ]);

        $p3 = Genero::firstOrCreate([
            'nome' =>'Homem Transgênero'
        ]);

        $p4 = Genero::firstOrCreate([
            'nome' =>'Mulher Transgênero'
        ]);

        $p5 = Genero::firstOrCreate([
            'nome' =>'Homem Transexual'
        ]);

        $p6 = Genero::firstOrCreate([
            'nome' =>'Mulher Transexual'
        ]);

        $p7 = Genero::firstOrCreate([
            'nome' =>'Cisgênero'
        ]);

        $p8 = Genero::firstOrCreate([
            'nome' =>'Não sabe responder'
        ]);

        $p9 = Genero::firstOrCreate([
            'nome' =>'Prefere não responder'
        ]);

        $p10 = Genero::firstOrCreate([
            'nome' =>'Outros'
        ]);
    }
}

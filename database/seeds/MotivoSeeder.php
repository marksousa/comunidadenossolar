<?php

use Illuminate\Database\Seeder;
use App\Motivo;

class MotivoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $p1 = Motivo::firstOrCreate([
            'nome' =>'Conflito Existencial'
        ]);

        $p2 = Motivo::firstOrCreate([
            'nome' =>'Busca Espiritual'
        ]);

        $p3 = Motivo::firstOrCreate([
            'nome' =>'Problema Familiar'
        ]);

        $p4 = Motivo::firstOrCreate([
            'nome' =>'Formação Profissional'
        ]);

        $p5 = Motivo::firstOrCreate([
            'nome' =>'Formação Pedagógica'
        ]);

        $p6 = Motivo::firstOrCreate([
            'nome' =>'Auxílio Social'
        ]);

        $p7 = Motivo::firstOrCreate([
            'nome' =>'Outros'
        ]);
    }
}

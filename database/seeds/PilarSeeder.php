<?php

use Illuminate\Database\Seeder;

class PilarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('pilares')->insert(['nome' => 'Comunicação', 'areas' => 'Comunicação']);
      DB::table('pilares')->insert(['nome' => 'Doutrinário', 'areas' => 'Doutrinário']);
      DB::table('pilares')->insert(['nome' => 'Formação Pedagógica', 'areas' => 'Formação Pedagógica']);
      DB::table('pilares')->insert(['nome' => 'Saúde', 'areas' => 'Saúde']);
      DB::table('pilares')->insert(['nome' => 'Valorização do Ser', 'areas' => 'Valorização do Ser']);

    }
}

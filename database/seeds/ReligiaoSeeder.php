<?php

use Illuminate\Database\Seeder;
use App\Religiao;

class ReligiaoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Religiao::firstOrCreate(['nome' =>'Catolicismo']);
        Religiao::firstOrCreate(['nome' =>'Espiritismo']);
        Religiao::firstOrCreate(['nome' =>'Matrizes afro-brasileiras']);
        Religiao::firstOrCreate(['nome' =>'Outras religiões']);
        Religiao::firstOrCreate(['nome' =>'Protestantismo']);
        Religiao::firstOrCreate(['nome' =>'Sem religião']);
        Religiao::firstOrCreate(['nome' =>'Prefere não responder']);
    }
}

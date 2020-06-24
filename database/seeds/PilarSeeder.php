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
        DB::table('pilares')->insert(['nome' => 'Comunicação', 'areas' => 'Jornalismo, Mídias, Redes Sociais, Site']);
        DB::table('pilares')->insert(['nome' => 'Doutrinário', 'areas' => 'Atendimento Fraterno, Biblioteca, Estudos, Evanelho no Lar, Evangelização infantil, Eventos, Mediúnica, Mocidade, Palestras, Recepção, Trabalhos de Caridade, Tratamento Espiritual']);
        DB::table('pilares')->insert(['nome' => 'Educação', 'areas' => 'Artes, Assistência Escolar, Educação Física / Esporte, Escola Integral, Formaçao Profissional, Informática, Línguas Estrangeiras, Música']);
        DB::table('pilares')->insert(['nome' => 'Saúde', 'areas' => 'Acupuntura, Farmácia, Fisioterapia, Fonoaudiologia, Odontologia, Medicina (Atendimento Clínico e Exames), Meditação, Nutrição, Odontologia, Psicologia, Psiquiatria, Terapia Ocupacional, Veterinária, Yoga']);
        DB::table('pilares')->insert(['nome' => 'Valorização do Ser', 'areas' => 'Abrigo, Acolha-me, Casa de Passagem, Cozinha, Doações, Gestantes, Oficinas, Jurídico, Lavanderia, Serviços']);
    }
}




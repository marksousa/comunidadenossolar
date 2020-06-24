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
<<<<<<< HEAD
    	DB::table('pilares')->insert(['nome' => 'Comunicação', 'areas' => 'Comunicação']);
	    DB::table('pilares')->insert(['nome' => 'Doutrinário', 'areas' => 'Doutrinário']);
	    DB::table('pilares')->insert(['nome' => 'Formação Pedagógica', 'areas' => 'Formação Pedagógica']);
	    DB::table('pilares')->insert(['nome' => 'Saúde', 'areas' => 'Saúde']);
	    DB::table('pilares')->insert(['nome' => 'Valorização do Ser', 'areas' => 'Valorização do Ser']);
=======
        DB::table('pilares')->insert(['nome' => 'Comunicação', 'areas' => 'Criação, Jornalismo, Redes sociais']);
        DB::table('pilares')->insert(['nome' => 'Doutrinário', 'areas' => 'Arrecadação, Atendimento Fraterno, Biblioteca, Campanha do quilo, Coro, Estudos, Evangelização infantil, Mocidade Espírita, Palestras, Passes, Recepção, Sopa']);
        DB::table('pilares')->insert(['nome' => 'Formação Pedagógica', 'areas' => 'Alfabetização de Adultos, Assistência Escolar, Ballet, Curso Jovem Aprendiz, Cursos Profissionalizantes, Esportes, Informática, Línguas, Música, Preparatório ENEM']);
        DB::table('pilares')->insert(['nome' => 'Saúde', 'areas' => 'Clínicos/Exames, Enfermagem, Farmácia, Fisioterapia, Horta Medicinal, Odontologia, Oftalmologia, Meditação, Psicologia, Puericultura/Pré-Natal, Veterinária, Yoga']);
        DB::table('pilares')->insert(['nome' => 'Valorização do Ser', 'areas' => 'Abrigo, Acolha-me, Casa de Passagem, Doações, Gestantes, Oficinas, Inserção no Mercado de Trabalho, Jovem aprendiz, Jurídico, Lavanderia, Sopa, Visitas (abrigos e hospitais)']);
>>>>>>> 63ae194a2a882c3cd53f8752739363ab469b1348
    }
}




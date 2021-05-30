<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

use App\Mail\DataLimiteEmail;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->call(function () {            
            $data = new \DateTime('now');
            $data = $data->add(new \DateInterval('P2D'));

            $emprestimos = DB::table('emprestimo_contem_exemplar')
                ->join('exemplares', 'emprestimo_contem_exemplar.codigo_exemplar', '=', 'exemplares.codigo')
                ->join('livros', 'exemplares.id_livro', '=', 'livros.id')
                ->join('emprestimos', 'emprestimo_contem_exemplar.emprestimo_id', '=', 'emprestimos.id')
                ->join('estudantes', 'emprestimos.id_estudante', '=', 'estudantes.id')
                ->where('emprestimo_contem_exemplar.data_limite', $data->format('Y-m-d'))
                ->where('emprestimo_contem_exemplar.status', 0)
                ->select(
                    'emprestimo_contem_exemplar.data_limite', 'emprestimos.data_emprestimo', 'estudantes.nome',
                    'estudantes.matricula', 'estudantes.email', 'exemplares.codigo', 'livros.titulo', 'livros.autor', 'livros.editora', 
                    'livros.edicao', 'livros.volume'
                )
                ->orderBy('estudantes.matricula', 'asc')
                ->get();

            $emprestimo_por_estudante = [];
            $tamanho = count($emprestimos);
            for($i = 0; $i < $tamanho; $i++) {
                $matricula = $emprestimos[$i]->matricula;
                $count = 0;
                $e = [];

                while($count < $tamanho && $emprestimos[$count]->matricula === $matricula) {
                    $emprestimos[$count]->data_limite = (new \DateTime($emprestimos[$count]->data_limite))->format('d/m/Y');
                    $emprestimos[$count]->data_emprestimo = (new \DateTime($emprestimos[$count]->data_emprestimo))->format('d/m/Y');
                    array_push($e, $emprestimos[$count]);
                    $count += 1;
                }

                $emprestimo_por_estudante[$matricula] = $e;
                $i = $count;
            }

            foreach($emprestimo_por_estudante as $matricula => $emprestimos) {
                Mail::to($emprestimos[0]->email)->send(new DataLimiteEmail($emprestimos));
            }
        })->everyMinute();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}

<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class DataLimiteEmail extends Mailable
{
    use Queueable, SerializesModels;

    private $emprestimos;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($emprestimos)
    {
        $this->emprestimos = $emprestimos;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Lembrete de Renovação de Exemplares')->view('emails.dataLimite', ['emprestimos' => $this->emprestimos]);
    }
}

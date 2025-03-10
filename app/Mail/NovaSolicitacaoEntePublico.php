<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

use Illuminate\Support\Facades\Crypt;


class NovaSolicitacaoEntePublico extends Mailable
{
    use Queueable, SerializesModels;

    public $url;
    public $usuario;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($usuario)
    {
        $this->url = url('/ente_publico/usuario/' . Crypt::encrypt($usuario->id) );
        $this->usuario = $usuario;
        
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.modulo_sistema.nova_solicitacao_ente_publico');
    }
}

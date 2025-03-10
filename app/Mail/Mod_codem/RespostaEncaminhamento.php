<?php

namespace App\Mail\Mod_codem;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class RespostaEncaminhamento extends Mailable
{
    use Queueable, SerializesModels;

    public $url;
    public $encaminhamento;
    public $usuario;
   

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($encaminhamento, $usuario)
    {
        $this->url = url('/codem/demanda/encaminhamento/dados/');
        $this->encaminhamento = $encaminhamento;
        $this->usuario = $usuario;
      
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.modulo_codem.resposta_encaminhamento');
    }
}

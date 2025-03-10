<?php

namespace App\Mail\Mod_codem;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class EncaminhamentoDemanda extends Mailable
{
    use Queueable, SerializesModels;

    public $url;
    public $encaminhamento;
    public $usuarioDemandado;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($encaminhamento,$usuarioDemandado)
    {
        $this->url = url('/codem/demanda/encaminhamento/dados');
        $this->encaminhamento = $encaminhamento;
        $this->usuarioDemandado = $usuarioDemandado;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.modulo_codem.encaminhamento_demanda');
    }
}

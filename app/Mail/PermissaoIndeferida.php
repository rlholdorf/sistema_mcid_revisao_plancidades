<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class PermissaoIndeferida extends Mailable
{
    use Queueable, SerializesModels;

    public $url;
    public $permissao;
    public $usuario;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($permissao, $usuario)
    {
        $this->url = url('/login');
        $this->permissao = $permissao;
        $this->usuario = $usuario;
        
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.modulo_sistema.permissao_indeferida');
    }
}

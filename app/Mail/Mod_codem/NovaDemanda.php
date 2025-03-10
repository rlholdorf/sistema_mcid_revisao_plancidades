<?php

namespace App\Mail\Mod_codem;

use App\Mod_codem\RelacaoDemandas;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class NovaDemanda extends Mailable
{
    use Queueable, SerializesModels;

    public $url;
    public $usuario;
    public $demanda;
   

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($demanda, $usuario)
    {
        $this->url = url('/codem/demanda/dados/'.$demanda->id.'/demanda');
        $this->demanda = RelacaoDemandas::where('demanda_id',$demanda->id)->first();
        $this->usuario = $usuario;
      
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.modulo_codem.nova_demanda');
    }
}

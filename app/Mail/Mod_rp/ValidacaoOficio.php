<?php

namespace App\Mail\Mod_rp;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ValidacaoOficio extends Mailable
{
    use Queueable, SerializesModels;

    public $url;
    public $oficio;
    public $dadosArquivoHabilitacao;
    public $dadosHabManual;
    public $dadosHabLote;
    public $dadosHabInvalidada;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($oficio, $dadosArquivoHabilitacao)
    {
        $this->url = url('/rp/rp8/validado/oficio/' . $oficio->id);
        $this->oficio = $oficio;
        $this->dadosArquivoHabilitacao = $dadosArquivoHabilitacao;
        $this->dadosHabManual = [];
        $this->dadosHabLote = [];
        $this->dadosHabInvalidada = [];

        foreach ($this->dadosArquivoHabilitacao as $dados) {
            if ($dados->tipo_habilitacao_cnpj_id == 1) {
                array_push($this->dadosHabManual, $dados);
            } else if ($dados->tipo_habilitacao_cnpj_id == 2) {
                array_push($this->dadosHabLote, $dados);
            } else {
                array_push($this->dadosHabInvalidada, $dados);
            }
        }
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.modulo_rp.validacao_oficio');
    }
}
<?php

/**
 * Classe para fazer Flash messages
 */

namespace App\Http;

class Flash
{
	// metodo base dos demais
	public function criar($titulo, $mensagem, $tipo, $key = 'flash_message')
	{
		return session()->flash($key, [
			'titulo' => $titulo,
			'mensagem' => $mensagem,
			'tipo' => $tipo
		]);
	}

	public function sucesso($titulo, $mensagem)
	{
		return $this->criar($titulo, $mensagem, 'success');
	}

	public function erro($titulo, $mensagem)
	{
		return $this->criar($titulo, $mensagem, 'error');
	}

	public function info($titulo, $mensagem)
	{
		return $this->criar($titulo, $mensagem, 'info');
	}

	public function confirma($titulo, $mensagem, $tipo = 'success')
	{
		return $this->criar($titulo, $mensagem, $tipo, 'flash_message_overlay');
	}

	public function warning($titulo, $mensagem)
	{
		return $this->criar($titulo, $mensagem, 'warning');
	}
}
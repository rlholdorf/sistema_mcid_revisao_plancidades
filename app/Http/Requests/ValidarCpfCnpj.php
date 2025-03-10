<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;


class ValidarCpfCnpj extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'ente_publico_id' => 'required|cnpj',
            'txt_cpf_usuario' => 'required|cpf|usuariobloqueado',
            
        ];
    }

    public function messages()
    {
        return [
            'ente_publico_id.required' => 'O campo cnpj é obrigatório.',
            'ente_publico_id.cnpj' =>'O cnpj está inválido.',      
            'txt_cpf_usuario.required' => 'O campo cpf é obrigatório.',
            'txt_cpf_usuario.cpf' =>'O cpf está inválido.',
            'txt_cpf_usuario.usuariobloqueado' =>'Usuário Inexistente, bloqueado ou excluído do sistema.',

           
            
        ];
    }
}

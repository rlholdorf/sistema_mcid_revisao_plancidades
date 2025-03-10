<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;


class RegistroUsuario extends FormRequest
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
            'name' => 'required|min:3|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
           // 'txt_cpf_usuario' => 'cpf',   
           // 'tipo_usuario_id' => 'required',            
           // 'modulo_sistema_id' => 'required',
            //'ente_publico_id' => 'required',
            
                                           
           
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'O campo Nome é obrigatório',      
            'name.min' => 'O campo Nome  deve ter pelo menos 6 caracteres', 
            'name.max' => 'Utilize até 255 caracteres',  
            'email.required' => 'O campo Email é obrigatório',    
            'email.email' => 'Não é um Email válido',
            'email.max' => 'Utilize até 255 caracteres',
            'email.unique' => 'O Email já está cadastrado no Sistema',
            //'tipo_usuario_id.required' => 'A Tipo Usuário é obrigatório.',                            
            //'ente_publico_id.required' => 'A Ente Público é obrigatório.',                            
            //'modulo_sistema_id.required' => 'A Modulo Sistema é obrigatório.',                            
            'password.required' => 'A senha é obrigatória.',                            
            'password.min' => 'A senha deve ter pelo menos 6 caracteres',                            
            'password.confirmed' => 'A confirmação da senha não confere.',  
          //  'txt_cpf_usuario.required' => 'O campo cpf é obrigatório.',
            //'txt_cpf_usuario.cpf' =>'O cpf está inválido.',
          //  'txt_cpf_usuario.unique' =>'O cpf já está em uso.',


           
        ];
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;


class RegistroUsuarioAdesaoPropostas extends FormRequest
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
            'estado' => 'required',
            'municipio' => 'required',
            'txt_cnpj' => 'required|cnpj',
            'txt_nome_proponente' => 'required|max:255',
            'txt_email_ente_publico' => 'required|email|max:255',                                
            'cargo_executivo' => 'required',
            'txt_nome_chefe_executivo' => 'required|max:255',
            'txt_nome' => 'required|max:255',
            'txt_sobrenome' => 'required|max:255',
            'txt_cpf_usuario' => 'required|cpf',
            'txt_cargo' => 'required|max:255',
            'txt_ddd' => 'required|max:255',
            'txt_telefone' => 'required|max:255',
           // 'txt_ddd_movel' => 'required|max:255',
          //  'txt_celular' => 'required|max:255',
            'email' => 'required|email|unique:users|max:255', 
                                           
           
        ];
    }

    public function messages()
    {
        return [
            'estado.required' => 'O campo estado é obrigatório',      
            'municipio.required' => 'O campo município é obrigatório',   
            'txt_cnpj.required' => 'O campo cnpj é obrigatório.',
            'txt_cnpj.cnpj' =>'O cnpj está inválido.',      
            'txt_nome_proponente.required' => 'O campo nome do proppnente é obrigatório',       
            'txt_nome_proponente.max' => 'Utilize até 255 caracteres',  
            'txt_email_ente_publico.required' => 'O campo email é obrigatório',    
            'txt_email_ente_publico.email' => 'Não é um email válido',
            'txt_email_ente_publico.max' => 'Utilize até 255 caracteres',
            //'txt_email_ente_publico.unique' => 'O email já está cadastrado no Sistema',
            'cargo_executivo.required' => 'O campo cargo do executivo é obrigatório',  
            'txt_nome_chefe_executivo.required' => 'O campo nome do chefe do executivo é obrigatório',       
            'txt_nome_chefe_executivo.max' => 'Utilize até 255 caracteres',   
            'txt_nome.required' => 'O campo nome é obrigatório',       
            'txt_nome.max' => 'Utilize até 255 caracteres',   
            'txt_sobrenome.required' => 'O campo sobrenome é obrigatório',       
            'txt_sobrenome.max' => 'Utilize até 255 caracteres',       
            'txt_cpf_usuario.required' => 'O campo cpf é obrigatório.',
            'txt_cpf_usuario.cpf' =>'O cpf está inválido.',
            'txt_cpf_usuario.unique' =>'O cpf já está em uso.',
            'txt_cargo.required' => 'O campo cargo é obrigatório',       
            'txt_cargo.max' => 'Utilize até 255 caracteres',   
            'txt_ddd.required' => 'O campo ddd é obrigatório',       
            'txt_ddd.max' => 'Utilize até 255 caracteres',   
            'txt_telefone.required' => 'O campo telefone é obrigatório',       
            'txt_telefone.max' => 'Utilize até 255 caracteres',     
          //  'txt_ddd_movel.required' => 'O campo ddd é obrigatório',       
          //  'txt_ddd_movel.max' => 'Utilize até 255 caracteres',   
         //   'txt_celular.required' => 'O campo celular é obrigatório',       
          //  'txt_celular.max' => 'Utilize até 255 caracteres',       
            'email.required' => 'O campo email é obrigatório',    
            'email.email' => 'Não é um email válido',
            'email.max' => 'Utilize até 255 caracteres',
            'email.unique' => 'O email já está cadastrado no SISHAB',
           
        ];
    }
}

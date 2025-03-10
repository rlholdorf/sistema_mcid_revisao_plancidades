<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

use App\Http\Requests\NovaSenha;


class NovaSenha extends FormRequest
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
        if(Auth::User()->tipo_usuario_id==8){
            if(Auth::User()->txt_cpf_usuario){
                return [
                    'password' => 'required|min:6|confirmed',
                    'name' => 'required|min:3',
                    'txt_cargo' => 'required|min:3',
                    'txt_cpf_usuario' => 'required|cpf',
                    ];
            }else{
                return [
                    'password' => 'required|min:6|confirmed',
                    'name' => 'required|min:3',
                    'txt_cargo' => 'required|min:3',
                    'txt_cpf_usuario' => 'required|cpf|unique:users',
                    ];
                }        
        }else if(Auth::User()->tipo_usuario_id==9){  
                return [
                    'password' => 'required|min:6|confirmed',
                    'name' => 'required|min:3',
                    'txt_cargo' => 'required|min:3',
                    
                    ];
            }else if(Auth::User()->modulo_sistema_id == 1){  
                return [
                    'password' => 'required|min:6|confirmed',
                    ];
            }

            
        
    }

     public function messages()
    {

        if(Auth::User()->tipo_usuario_id==8){
            return [
                'password.required' => 'A nova senha é obrigatória.',                            
                'password.min' => 'A nova senha deve ter pelo menos 6 caracteres',                            
                'password.confirmed' => 'A confirmação da senha não confere.',     
                'name.required' => 'O campo Nome é obrigatório.',                            
                'name.min' => 'O campo Nome  deve ter pelo menos 6 caracteres', 
                'txt_cargo.required' => 'O campo Cargo é obrigatória.',                            
                'txt_cargo.min' => 'O campo Cargo deve ter pelo menos 6 caracteres',  
                'txt_cpf_usuario.required' => 'O campo cpf é obrigatório.',
                'txt_cpf_usuario.cpf' =>'O cpf está inválido.',
                'txt_cpf_usuario.unique' =>'O cpf já está em uso.',                       
            ];
                   
                
            }else if(Auth::User()->tipo_usuario_id==9){  
                return [
                        'password.required' => 'A nova senha é obrigatória.',                            
                        'password.min' => 'A nova senha deve ter pelo menos 6 caracteres',                            
                        'password.confirmed' => 'A confirmação da senha não confere.',     
                        'name.required' => 'O campo Nome é obrigatório.',                            
                        'name.min' => 'O campo Nome  deve ter pelo menos 6 caracteres', 
                        'txt_cargo.required' => 'O campo Cargo é obrigatória.',                            
                        'txt_cargo.min' => 'O campo Cargo deve ter pelo menos 6 caracteres',  
                        'txt_cpf_usuario.required' => 'O campo cpf é obrigatório.',
                        'txt_cpf_usuario.cpf' =>'O cpf está inválido.',                     
                    ];
            }else if(Auth::User()->modulo_sistema_id == 1){ 
                return [
                    'password.required' => 'A nova senha é obrigatória.',                            
                    'password.min' => 'A nova senha deve ter pelo menos 6 caracteres',                            
                    'password.confirmed' => 'A confirmação da senha não confere.',
                ];     
                         
            }
    }
}

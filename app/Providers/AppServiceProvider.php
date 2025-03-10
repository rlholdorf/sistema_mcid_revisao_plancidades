<?php

namespace App\Providers;

use App\User;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\URL;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;





use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Blade;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

        if (env('APP_ENV') === 'production') {
            \URL::forceScheme('https');
        }


        Validator::extend('usuariobloqueado', function ($attribute, $value, $parameters, $validator) {


            $usuario = User::where('txt_cpf_usuario', $value)->get();

            if (count($usuario) > 0) {
                $usuario = User::where('txt_cpf_usuario', $value)->first();

                if ($usuario->status_usuario_id >= 3) {
                    return false;
                } else {
                    return true;
                }
            } else {
                return false;
            }
        });
        //////////////inicio validador de CPF///////////////////////

        Validator::extend('cpf', function ($attribute, $value, $parameters, $validator) {
            /*
                        * Salva em $cpf apenas numeros, isso permite receber o cpf em diferentes formatos,
                        * como "000.000.000-00", "00000000000", "000 000 000 00"
                        */
            $cpf = preg_replace('/\D/', '', $value);
            $num = array();

            /* Cria um array com os valores */
            for ($i = 0; $i < (strlen($cpf)); $i++) {

                $num[] = $cpf[$i];
            }

            if (count($num) != 11) {
                return false;
            } else {

                for ($i = 0; $i < 10; $i++) {
                    if (
                        $num[0] == $i && $num[1] == $i && $num[2] == $i
                        && $num[3] == $i && $num[4] == $i && $num[5] == $i
                        && $num[6] == $i && $num[7] == $i && $num[8] == $i
                    ) {
                        return false;
                        break;
                    }
                }
            }

            $j = 10;
            for ($i = 0; $i < 9; $i++) {
                $multiplica[$i] = $num[$i] * $j;
                $j--;
            }
            $soma = array_sum($multiplica);
            $resto = $soma % 11;
            if ($resto < 2) {
                $dg = 0;
            } else {
                $dg = 11 - $resto;
            }
            if ($dg != $num[9]) {
                return false;
            }
            /*
                    Calcula e compara o
                    segundo dígito verificador.
                    */
            $j = 11;
            for ($i = 0; $i < 10; $i++) {
                $multiplica[$i] = $num[$i] * $j;
                $j--;
            }
            $soma = array_sum($multiplica);
            $resto = $soma % 11;
            if ($resto < 2) {
                $dg = 0;
            } else {
                $dg = 11 - $resto;
            }
            if ($dg != $num[10]) {
                return false;
            } else {
                return true;
            }
        });
        //////////////fim validador de CPF///////////////////////

        //////////////inicio validador de CNPJ///////////////////////

        Validator::extend('cnpj', function ($attribute, $value, $parameters, $validator) {
            /*
                Etapa 1: Cria um array com apenas os digitos numéricos,
                isso permite receber o cnpj em diferentes
                formatos como "00.000.000/0000-00", "00000000000000", "00 000 000 0000 00"
                etc...
                */
            $cnpj = preg_replace('/\D/', '', $value);
            $num = array();

            /* Cria um array com os valores */
            for ($i = 0; $i < (strlen($cnpj)); $i++) {

                $num[] = $cnpj[$i];
            }

            //Etapa 2: Conta os dígitos, um Cnpj válido possui 14 dígitos numéricos.
            if (count($num) != 14) {
                return false;
            }
            /*
                Etapa 3: O número 00000000000 embora não seja um cnpj real resultaria
                um cnpj válido após o calculo dos dígitos verificares
                e por isso precisa ser filtradas nesta etapa.
                */
            if (
                $num[0] == 0 && $num[1] == 0 && $num[2] == 0
                && $num[3] == 0 && $num[4] == 0 && $num[5] == 0
                && $num[6] == 0 && $num[7] == 0 && $num[8] == 0
                && $num[9] == 0 && $num[10] == 0 && $num[11] == 0
            ) {
                return false;
            }
            //Etapa 4: Calcula e compara o primeiro dígito verificador.
            else {
                $j = 5;
                for ($i = 0; $i < 4; $i++) {
                    $multiplica[$i] = $num[$i] * $j;
                    $j--;
                }
                $soma = array_sum($multiplica);
                $j = 9;
                for ($i = 4; $i < 12; $i++) {
                    $multiplica[$i] = $num[$i] * $j;
                    $j--;
                }
                $soma = array_sum($multiplica);
                $resto = $soma % 11;
                if ($resto < 2) {
                    $dg = 0;
                } else {
                    $dg = 11 - $resto;
                }
                if ($dg != $num[12]) {
                    return false;
                }
            }
            //Etapa 5: Calcula e compara o segundo dígito verificador.

            $j = 6;
            for ($i = 0; $i < 5; $i++) {
                $multiplica[$i] = $num[$i] * $j;
                $j--;
            }
            $soma = array_sum($multiplica);
            $j = 9;
            for ($i = 5; $i < 13; $i++) {
                $multiplica[$i] = $num[$i] * $j;
                $j--;
            }
            $soma = array_sum($multiplica);
            $resto = $soma % 11;
            if ($resto < 2) {
                $dg = 0;
            } else {
                $dg = 11 - $resto;
            }
            if ($dg != $num[13]) {
                return false;
            } else {
                return true;
            }
        });



        //////////////FIM validador de CNPJ///////////////////////

        //validar email diferentes form termo adesao parcerias
        Validator::extend('validar_emails_diferentes', function ($attribute, $value, $parameters, $validator) {
            $emailUsuario = $parameters[0];
            $emailEnte = $parameters[1];
            $itens = $validator->getData();
            // dd('.' . $itens[$emailUsuario] .'=='. $itens[$emailEnte]);

            if ($itens[$emailUsuario] == $itens[$emailEnte]) {
                return false;
            } else {
                return true;
            }
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}

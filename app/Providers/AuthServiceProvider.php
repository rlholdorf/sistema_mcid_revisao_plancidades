<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();


        Gate::define('eDev', function ($user) {
            if (($user->tipo_usuario_id == 1) || ($user->tipo_usuario_id == 20)) {
                return true;
            }
            return false;
        });


        Gate::define('eAdmin', function ($user) {

            if (($user->tipo_usuario_id == 1)) {
                return true;
            }
            return false;
        });

        Gate::define('eGestao', function ($user) {
            if (($user->tipo_usuario_id == 1) || ($user->tipo_usuario_id == 2) || ($user->tipo_usuario_id == 6)) {
                return true;
            }
            return false;
        });

        Gate::define('ePlancidades', function($user){
            $tipoUsuario = [21, 22, 23]; //tipos de usuários do plancidades
            
            if(in_array($user->tipo_usuario_id, $tipoUsuario)){
                return true;
            }
            return false;
        });

        Gate::define('ePlancidadesValidacao', function($user){    
            
            $tipoUsuario = [1, 20, 22, 23];     

            if(in_array($user->tipo_usuario_id, $tipoUsuario)){
                return true;
            }
            return false;
        });

        // Gate::define('ePlancidades', function($user){
        //     if(true){
        //         return true;
        //     }
        //     return false;
        // });

        Gate::define('eConsulta', function ($user) {

            $tipoUsuario = [1, 2, 3, 4, 5, 6];

            if (in_array($user->tipo_usuario_id, $tipoUsuario)) {
                return true;
            }
            return false;
        });

        Gate::define('eMaster', function ($user) {
            if (($user->tipo_usuario_id == 1)  || ($user->tipo_usuario_id == 6)) {
                return true;
            }
            return false;
        });
    }
}
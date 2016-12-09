<?php

namespace Core\Authentication;

use \Core\Models\User;
use \Core\Models\Role;
use \Core\Models\Permission;

Class Auth{

    public function user()
    {   
        return $this->signed() ? User::with(['role' => function($q){ $q->with('permissions'); }])->find($_SESSION['user']) : null;
    }

    // public static function roles()
    // {   
    //     if ( Environment::getGlobal('roles') == null) {
    //         Environment::setGlobal('roles', Role::all());
    //     }
    //     return Environment::getGlobal('roles');
    // }

    // public static function permissions()
    // {   
    //     if ( Environment::getGlobal('permissions') == null) {
    //         Environment::getGlobal('permissions', Permission::all());
    //     }
    //     return Environment::getGlobal('permissions');
    // }

    public function signed()
    {
        return isset($_SESSION['user']);
    }

    public function sign_out()
    {
        unset($_SESSION['user']);
    }

    public function attempt($username, $password)
    {
        $user = User::where('username', $username)->first();
        // echo "<pre>";
        // print_r($user);
        // die();

        if(!$user){
            return false;
        }
        
        if(password_verify($password, $user->password)){
            $_SESSION['user'] = $user->id;
            return $user;
        }
        
        return false;
    }
    

}
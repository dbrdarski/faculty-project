<?php

namespace Core\Authentication;

use \Core\Models\User;

Class Auth{

    public function user()
    {   
        return $this->signed() ? User::with(['roles' => function($q){ $q->with('permissions'); }])->find($_SESSION['user']) : null;
    }

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
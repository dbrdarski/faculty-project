<?php

namespace Core\Controllers;

use \Core\Models\User;
use \Core\Options\OptionManager;
use Respect\Validation\Validator as v;
use \Core\Containers\View;
use \Core\Containers\Model;

class AuthController extends Controller{

    public function signUpIndex($req, $res, $args)
    {
        $view = new View($res, $this);
        $model = new Model();        
        return $view("signup", $model());
                
    }
    public function createUser($req, $res, $args)
    {
        $view = new View($res, $this);
        $lecturers = User::where('type', 2)->get()->all();
        // echo '<pre>';
        // var_dump($lecturer);
        // die();
        $model = new Model();
        $model->append('lecturers', $lecturers);
        return $view("lecturer", $model());
    }    
}
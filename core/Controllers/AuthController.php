<?php

namespace Core\Controllers;

use \Core\Models\User;
use \Core\Options\OptionManager;
use Respect\Validation\Validator as v;
use \Core\Containers\View;
use \Core\Containers\Model;

class AuthController extends Controller{

    public function __construct($container)
    {
        $this->container = $container;
        self::$v = [
            'first_name' => v::notEmpty()->alpha(),
            'last_name' => v::notEmpty()->alpha(),
            'username' => v::notEmpty()->noWhitespace()->alnum()->usernameAvailable(),
            'email' => v::notEmpty()->email()->emailAvailable(),
            'password' => v::noWhitespace()->notEmpty(), 
            'confirm-password' => v::noWhitespace()->notEmpty()
        ];
    }

    static private $v;

    public function signUpIndex($req, $res, $args)
    {
        $view = new View($res, $this);
        $model = new Model();
        return $view("signup", $model());
    }
    
    public function signUpValidator($req, $res)
    {
        $args = $req->getParams();
        reset($args);
        $field = key($args);
        $value = $args[$field];
        $validation = isset(self::$v[$field]) ? $this->validator->validate($field, self::$v[$field], $value) : false;
        // if(isset(self::$v[$field]) && self::$v[$field]->validate($value) === true){
        //     return $res->withStatus(200);
        // }
        return $validation && $validation->success() ? $res->withStatus(200) : $res->withStatus(410)->withJson($validation->errors());
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
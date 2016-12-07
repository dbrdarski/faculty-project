<?php

namespace Core\Controllers;

use \Core\Models\User;
use \Core\Models\Role;
use \Core\Containers\Environment;
use Respect\Validation\Validator as v;
use \Core\Containers\View;
use \Core\Containers\Model;

class AdminController extends Controller
{

	public function adminUsersIndex($req, $res)
    {
        $view = new View($res, $this);
        $users = User::with('role')->get();
        $model = (new Model())->append('users',$users);
        
        return $view("admin/users", $model());
    }

	public function adminUsers($req, $res)
    {
        $users = User::with('role')->get(['id', 'email', 'first_name', 'last_name', 'username', 'type']);
        $roles = Role::all();

        return $res->withJson([
        	'users' => $users, 
            'roles' => $roles,
        	'csrf' => Environment::getGlobal('csrf')
        ]);

    }

	public function deleteUser($req, $res)
    {
        $user = User::where('username', $req->getParam('username'))->delete();
        $users = User::with('role')->get(['id', 'email', 'first_name', 'last_name', 'username', 'type']);
        $roles = Role::all();
        return $res->withJson([
        	'users' => $users, 
            'roles' => $roles,
        	'csrf' => Environment::getGlobal('csrf')
        ]);
    }
}
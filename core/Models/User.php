<?php

namespace Core\Models;

use Illuminate\Database\Eloquent\Model as Model;

class User extends Model
{
    protected $table = 'users';

    protected $fillable = [
        'email',
        'password',
        'first_name',
        'last_name',
        'type'
    ];

    public function courses()
    {
        return $this->hasMany(Course::class, 'lecturer_id');
    }

    public function setPassword($password)
    {
        $this->update([
            'password' => password_hash($password, PASSWORD_DEFAULT)
        ]);
    }
    public function add($email, $fname, $lname, $password)
    {
        $user = $this->create([
            'email' => $email,
            'password' => password_hash($password, PASSWORD_DEFAULT),
            'type' => $this->typeId,
            'first_name' => $fname,
            'last_name' => $lname            
        ]);
        return $user['attributes']['id'];
    }
}

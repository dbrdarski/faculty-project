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

    private $userRoles = ['admin', 'lecturer', 'student'];

    public function courses()
    {
        return $this->hasMany(Course::class, 'lecturer_id');
    }
    // public function lessions()
    // {
    //     // return $this->hasManyThrugh(Lessions::class, Course::class, 'id', 'course', 'lecturer_id');
    //     return $this->belongsToMany(Lessions::class, 'id', 'lecturer_id');
    // }
    public function lecturer()
    {
        $this->type = 2;
        return $this;
    }
    public function admin()
    {
        $this->type = 0;
        return $this;
    }
    public function student()
    {
        $this->type = 1;
        return $this;
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
            'type' => $this->type,
            'first_name' => $fname,
            'last_name' => $lname            
        ]);
        return $user['attributes']['id'];
    }

    public function createCourse($p){
        return $this->courses()->create([
            'title' => $p['title'],
            'slug' => $p['slug'],
            'description' => isset($p['description']) ? $p['description'] : "",
            'video' => isset($p['video']) ? $p['video'] : "",
            'color' => isset($p['color']) ? $p['color'] : 0,
            'image' => isset($p['image']) ? $p['image'] : "",
            'level' => isset($p['level']) ? $p['level'] : 0
        ]);
    }    
}

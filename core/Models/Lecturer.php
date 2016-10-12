<?php

namespace Core\Models;

use Core\Models\User as User;

class Lecturer extends User
{
    public $type = 'Lecturer';
    public $typeId = 2;

    
    public function createCourse($name, $desc){
        return $this->find(1)->courses()->create([
            'name' => $name,
            'description' => $desc
        ]);
    }

    public function courses()
    {
        return $this->hasMany(Course::class);
    }

}

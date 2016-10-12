<?php

namespace Core\Models;

use Core\Models\User as User;

class Student extends User
{
    public $type = 'Student';
    public $typeId = 3;

    
    public function enrollCourse($name, $desc){
        return $this->find(1)->courses()->create([
            'name' => $name,
            'description' => $desc
        ]);
    }

    public function subscriptions()
    {
        return $this->hasMany(Subscription::class);
    }
}

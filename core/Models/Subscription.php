<?php

namespace Core\Models;

use Illuminate\Database\Eloquent\Model as Model;

class Subscription extends Model
{
    protected $table = 'course_student';

    protected $fillable = [
        'grade',
        'rating'
    ];

    public function addCourse($name, $desc)
    {
        $t = $this->create([
            'name' => $name,
            'description' => $desc
        ]);

        // var_dump($t->id);
        return $t->id;
    }
}
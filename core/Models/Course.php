<?php

namespace Core\Models;

use Illuminate\Database\Eloquent\Model as Model;

class Course extends Model
{
    protected $table = 'courses';

    protected $fillable = [
        'name',
        'description'
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

    public function lecturers()
    {
        return $this->belongsTo(Lecturer::class);
    }
    public function students()
    {
        return $this->belongsToMany(Student::class);
    }

    // public function subscriptions()
    // {
    //     return $this->hasMany(Subscription::class);
    // }

}

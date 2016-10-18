<?php

namespace Core\Models;

use Illuminate\Database\Eloquent\Model as Model;

class Course extends Model
{
    protected $table = 'courses';

    protected $fillable = [
        'title',
        'slug',
        'description',
        'video',
        'image',
        'level',
        'color'
    ];

    public function addCourse($title, $slug)
    {
        $t = $this->create([
            'title' => $title,            
            'sluf' => $slug
        ]);

        // var_dump($t->id);
        return $t->id;
    }
    public static function getCourse($slug)
    {
        return self::where('slug', $slug)->first();
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

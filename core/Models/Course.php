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

    static private $colors = ['default', 'yellow', 'orange', 'red', 'violet', 'green', 'cyan', 'blue'];
    static private $levels = ['Beginner', 'Intermediate', 'Advanced'];

    public function getColorAttribute($value)
    {
        return self::$colors[$value];
    }
    public function getAuthorAttribute($value)
    {
        return "";
    }
    public function getLevelAttribute($value)
    {
        return self::$levels[$value];
    }

    public function users()
    {
        return $this->belongsTo(User::class, 'lecturer_id', 'id');
    }
    // public function students()
    // {
    //     return $this->belongsToMany(Student::class);
    // }

    public function addCourse($title, $slug)
    {
        $t = $this->create([
            'title' => $title,            
            'slug' => $slug
        ]);

        // var_dump($t->id);
        return $t->id;
    }
    public static function getCourse($slug)
    {
        return self::where('slug', $slug)->first();
    }

    // public function subscriptions()
    // {
    //     return $this->hasMany(Subscription::class);
    // }

}

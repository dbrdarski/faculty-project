<?php

namespace Core\Models;

use Illuminate\Database\Eloquent\Model as Model;
use \Core\Options\OptionManager;

class Course extends Model
{
    protected $table = 'courses';

    protected $fillable = [
        'title',
        'slug',
        'description',
        'level',
        'color',
        'image',
        'video',
        'active'
    ];

    public function getColorAttribute($value)
    {
        return OptionManager::getOption('colors')[$value];
    }
    public function getLevelAttribute($value)
    {
        return OptionManager::getOption('levels')[$value];
    }

    public function setLevelAttribute($value)
    {
        $this->attributes['level'] = array_search($value, OptionManager::getOption('levels'));
    }

    public function setColorAttribute($value)
    {
        $this->attributes['color'] = array_search($value, OptionManager::getOption('colors'));
    }    

    public function users()
    {
        return $this->belongsTo(User::class, 'lecturer_id', 'id');
    }
    public function students()
    {
        return $this->belongsToMany(User::class, 'student_id', 'id');
    }
    public function lessions()
    {
        return $this->hasMany(Lession::class);
    }
    public function publish()
    {
        $this->active = true;
        return $this;
    }
    public function unpublish()
    {
        $this->active = false;
        return $this;
    }
    // public function subscriptions()
    // {
    //     return $this->hasMany(Subscription::class);
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

    public function createLession($p){
        return $this->lessions()->create([
            'title' => $p['title'],
            'slug' => $p['slug'],
            'description' => isset($p['description']) ? $p['description'] : "",
            'video' => isset($p['video']) ? $p['video'] : "",
        ]);
    }    
}

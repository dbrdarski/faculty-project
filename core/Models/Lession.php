<?php

namespace Core\Models;

use Illuminate\Database\Eloquent\Model as Model;

class Lession extends Model
{
    protected $table = 'lessions';

    protected $fillable = [
        'name',
        'description',
        'video'
    ];

    public function addLession($name, $desc, $video)
    {
        $t = $this->create([
            'name' => $name,
            'description' => $desc,
            'video' => $video
        ]);

        // var_dump($t->id);
        return $t->id;
    }

    public function courses()
    {
        return $this->belongsTo(Course::class);
    }
    public function students()
    {
        return $this->belongsToMany(Student::class);
    }
}

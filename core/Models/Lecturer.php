// <?php

// namespace Core\Models;

// use Core\Models\User as User;

// class Lecturer extends User
// {
//     public $type = 'Lecturer';
//     public $typeId = 2;

    
//     public function createCourse($p){
//         return $this->courses()->create([
//             'title' => $p['title'],
//             'slug' => $p['slug'],
//             'description' => isset($p['description']) ? $p['description'] : "",
//             'video' => isset($p['video']) ? $p['video'] : "",
//             'color' => isset($p['color']) ? $p['color'] : 0,
//             'image' => isset($p['image']) ? $p['image'] : "",
//             'level' => isset($p['level']) ? $p['level'] : 0
//         ]);
//     }

//     // public function courses()
//     // {
//     //     return $this->hasMany(Course::class);
//     // }

// }

<?php

namespace Core\Models;

use Illuminate\Database\Eloquent\Model as Model;

class Role extends Model
{
    protected $table = 'users';

    protected $fillable = [
        'name',
        'description'
    ];


    public function users(){
        return $this->belongsToMany(User::class, 'type');
    }
    public function permissions()
    {
        return $this->hasMany(Permission::class, 'role_id');
    }
    public function addRole($p){
        return $this->courses()->create([
            'name' => $p['name'],
            'description' => isset($p['description']) ? $p['description'] : ""
        ]);
    }    
}

<?php

namespace Core\Models;

use Illuminate\Database\Eloquent\Model as Model;

class Permission extends Model
{
    protected $table = 'users';

    protected $fillable = [
        'name',
        'description'
    ];


    public function roles(){
        return $this->belongsToMany(Role::class, 'permission_id', 'id');
    }
    public function addRole($p){
        return $this->courses()->create([
            'name' => $p['name'],
            'description' => isset($p['description']) ? $p['description'] : ""
        ]);
    }    
}

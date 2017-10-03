<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Departments extends Model
{

    protected $primaryKey = 'department_id';

    protected $fillable = [
        'name',
    ];

    protected $hidden = [
        'remember_token',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function childs() {
        return $this->hasMany('App\Departments','parent_id','department_id') ;
    }

}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table = "users";
    protected $fillable = ['id','name','mobile'];
    protected $hidden = ['password', 'remember_token', 'created_at', 'updated_at','password', 'remember_token', 'created_at', 'updated_at'];
    protected $casts = ['email_verified_at' => 'datetime',];

    public function tasks(){
        return $this -> hasMany('App\Models\Task','user_id','id');
    }


}

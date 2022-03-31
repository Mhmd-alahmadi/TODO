<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected  $table = "list";
    protected  $fillable = ['id','name','type','user_id','created_at','updated_at'];
    protected $hidden = ['created_at','updated_at'];
    public $timestamps = true;

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id','id');
    }

}

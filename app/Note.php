<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Note extends Model
{
    use SoftDeletes;
    
    protected $fillable = ['note', 'title'];
    
    
    public function user() 
    {
        return $this->belongsTo('App\User');
    }
    
    public function tags()
    {
        return $this->belongsToMany('App\Tag');
    }
    
}

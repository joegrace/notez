<?php

namespace App\Repositories;

use App\Tag;

class TagsRepository 
{
    public function get($id) 
    {
        return Tag::find($id);
    }
    
    public function getByTagText($tag)
    {
        return Tag::where('text', $tag)->get();
    }
    
    public function save($tag)
    {
        $tag->save();
    }
    
}
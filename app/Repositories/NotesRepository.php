<?php

namespace App\Repositories;

use App\Note;

class NotesRepository 
{

    public function get($id)
    {
        return Note::find($id);
    }
    
    public function create($note)
    {
        $note->save();
    }
    
    public function save($note)
    {
        $note->save();
    }
    
    public function delete($note)
    {
        
    }
    
    /*
    * Get all notes by user
    */
    public function getByUser($userId)
    {
        $notes = Note::where('user_id', $userId)->get();
        
        return $notes;
    }
    
}
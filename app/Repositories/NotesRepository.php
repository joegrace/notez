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
        return $note;
    }
    
    public function delete($note)
    {
        $note->delete();
    }
    
    /*
    * Get all notes by user
    */
    public function getByUser($userId)
    {
        $notes = Note::where('user_id', $userId)
            ->with('tags')
            ->orderBy('created_at', 'desc')
            ->get();
        
        return $notes;
    }
    
}
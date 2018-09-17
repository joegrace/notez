<?php

namespace App\Services;

use App\Services\ServiceResponse;
use App\Repositories\NotesRepository;
use App\Note;

class NotesService 
{
    private $notesRepository;
    
    function __construct(NotesRepository $notesRepository)
    {
        $this->notesRepository = $notesRepository;
        
    }
    
    public function createOrSave($data)
    {
        // First we need to find out if we are
        // creating or saving.
        if (!isset($data['id'])) {
            // Create
            // Put together the new note
            $note = new Note();
            $note->fill($data);
            $note->user()->associate(\Auth::user());
            
            $this->notesRepository->create($note);
        } else {
            // Save
            app('Debugbar')::info('update');
            
            // Get the current note
            $note = $this->notesRepository->get($data['id']);
            $note->fill($data);
            
            // Now lets find out if we need to add tags.
            
            $this->notesRepository->save($note);
        }
        
    }
    
}
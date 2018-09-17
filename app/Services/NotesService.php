<?php

namespace App\Services;

use App\Services\ServiceResponse;
use App\Repositories\NotesRepository;
use App\Repositories\TagsRepository;
use App\Note;
use App\Tag;

class NotesService 
{
    private $notesRepository;
    private $tagsRepository;
    
    function __construct(NotesRepository $notesRepository, TagsRepository $tagsRepository)
    {
        $this->notesRepository = $notesRepository;
        $this->tagsRepository = $tagsRepository;
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
            $tagsToAssociate = [];
            if (isset($data['tags'])) {
                foreach ($data['tags'] as $tag) {
                    if (!isset($tag['id'])) {
                        // Create the new tag
                        $t = new Tag();
                        $t->text = $tag['text'];
                        
                        $this->tagsRepository->save($t);
                        array_push($tagsToAssociate, $t->id);
                    } else {
                        // Get this tag by id and push
                        $t = $this->tagsRepository->get($tag['id']);
                        
                        if ($t == null) {
                            throw new \Exception("Could not find passed tag id");
                        }
                        
                        array_push($tagsToAssociate, $t->id);
                    }
                }
                
                // Now sync these
                $note->tags()->sync($tagsToAssociate);
            }
            
            $this->notesRepository->save($note);
        }
        
    }
    
}
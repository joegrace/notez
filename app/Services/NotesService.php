<?php

namespace App\Services;

use App\Services\ServiceResponse;
use App\Repositories\NotesRepository;
use App\Repositories\TagsRepository;
use App\Note;
use App\Tag;
use Carbon\Carbon;
use App\Exceptions\NoteNewerOnServerException;

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

            // We need to check if the note's updated_at is greater than
            // the date on the passed data. If it is, then we do not want
            // to save this note becase we may be overwriting another save.
            if (isset($data['updated_at'])) {
                $dateFormat = 'Y-m-d H:i:s';
                $passedUpdatedDate = Carbon::createFromFormat($dateFormat, $data['updated_at']);
                
                \Log::info('Passed Date: ' . $passedUpdatedDate);
                \Log::info('DB Update date: ' . $note->updated_at);

                if ($note->updated_at->greaterThan($passedUpdatedDate)) {
                    throw new NoteNewerOnServerException("Cannot save this note. Database copy is newer. DB: {$note->updated_at}. Passed: {$passedUpdatedDate}");
                }
            }
        }
            
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
        $savedNote = $this->notesRepository->save($note);
        $savedNote = $this->notesRepository->get($savedNote->id);
        
        return $savedNote;
    }
    
    public function deleteById($id)
    {
        $note = $this->notesRepository->get($id);
        
        if ($note == null) {
            throw new \Exception('Entity not found');
        }
        
        $this->notesRepository->delete($note);

        
    }
    
}
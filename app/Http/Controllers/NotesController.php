<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\NotesService;
use App\Repositories\NotesRepository;
use App\Exceptions\NoteNewerOnServerException;

class NotesController extends Controller
{
    private $notesService;
    
    function __construct(NotesService $notesService, NotesRepository $notesRepository)
    {
        $this->notesService = $notesService;
        $this->notesRepository = $notesRepository;
    }
    
    
    public function store(Request $request)
    {
        $data = $request->json()->all();
        
        try {
            $savedNote = $this->notesService->createOrSave($data);
        }
        catch(NoteNewerOnServerException $ex) {
            // Note newer on server, send 400
            return response()->json([
                'noteError' => 'The note is newer on the server than your copy. Please refresh.'
            ], 400);
        }
        
        return $savedNote;
    }
    
    public function getAll(Request $request)
    {
        $user = \Auth::user();
        $notes = $this->notesRepository->getByUser($user->id);
        
        return $notes;
    }
    
    public function deleteNote(Request $request, $id)
    {
        $this->notesService->deleteById($id);

        return ['deleted' => true];
    }
    
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\NotesService;
use App\Repositories\NotesRepository;

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
        
        $savedNote = $this->notesService->createOrSave($data);
        
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

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
        
        $this->notesService->createOrSave($data);
    }
    
    public function getAll(Request $request)
    {
        $user = \Auth::user();
        $notes = $this->notesRepository->getByUser($user->id);
        
        return $notes;
    }
    
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\UserService;

class UserController extends Controller
{
    /** @var UserService */
    private $userService;

    function __construct(UserService $userService) 
    {
        $this->userService = $userService;
    }

    
    public function changePassword(Request $request) 
    {
        $data = $request->json()->all();

        $response = $this->userService->changePassword(\Auth::user(), 
            $data['password'], 
            $data['passwordConfirm']
        );

        return $response;
    }

}

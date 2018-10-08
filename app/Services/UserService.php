<?php

namespace App\Services;

use App\Services\ServiceResponse;
use App\Repositories\UserRepository;
use App\User;

class UserService 
{
    private $userRepository;

    function __construct(UserRepository $userRepository) 
    {
        $this->userRepository = $userRepository;
    }


    public function changePassword(User $user, $password, $passwordConfirm)
    {
        $errors = [];

        if ($password == null || $password == '') {
            array_push($errors, 'Password is a required field.');
        }

        if ($passwordConfirm == null || $passwordConfirm == '') {
            array_push($errors, 'Password confirm is a required field.');
        }

        if ($password != $passwordConfirm) {
            array_push($errors, "Password and password confirm do not match.");
        }

        if (count($errors) > 0) {
            $response = new ServiceResponse();
            $response->message = 'Validation Error.';
            $response->errors = $errors;
            $response->success = false;

            return $response;
        }

        $this->userRepository->changePassword($user, $password);

        $response = new ServiceResponse();
        $response->message = 'Saved';
        $response->success = true;

        return $response;
    }


}
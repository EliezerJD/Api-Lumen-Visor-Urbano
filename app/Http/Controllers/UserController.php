<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\Implementation\UserServiceImplementation;
use App\Validator\UserValidator;
use App\Model\User;

class UserController extends Controller
{
    private $userService;

    private $request;

    private $validator;

    public function __construct(UserServiceImplementation $userService, Request $request, UserValidator $userValidator)
    {
        $this->userService = $userService;

        $this->request = $request;

        $this->validator = $userValidator;
    }

    function store()
    {
        $response = response("", 201);

        $validator = $this->validator->validateStore();

        if($validator->fails())
        {
            $response = response([
                "status" => 422,
                "message" => "Error",
                "errors" => $validator->errors()
            ], 422);
        }
        else 
        {
            $this->userService->store($this->request->all());
        }

        return $response;
    }

    function getAll()
    {
        return response($this->userService->getAll());
    }

    function getUserById(int $id)
    {
        return response($this->userService->getUserById($id));
    }

    function update(int $id)
    {
        $response = response("", 202);

        $validator = $this->validator->validateUpdate();

        if($validator->fails())
        {
            $response = response([
                "status" => 422,
                "message" => "Error",
                "errors" => $validator->errors()
            ], 422);
        }
        else 
        {
            $this->userService->update($this->request->all(), $id);
        }

        return $response;
    }

    function delete(int $id)
    {
        $this->userService->delete($id);

        return response("", 204);
    }

    function getAllUsersDeleted()
    {
        return response($this->userService->getAllUsersDeleted());
    }

    function restore(int $id)
    {
        $this->userService->restore($id);

        return response("", 204);
    }

    public function login(Request $request)
    {
        return response($this->userService->login($this->request->all()));
    }

}

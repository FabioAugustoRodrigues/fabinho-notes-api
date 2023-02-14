<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController;
use App\Http\Resources\UserCollection;
use App\Http\Resources\UserResource;
use App\Services\User\UserService;
use Illuminate\Http\Request;

class UserController extends BaseController
{

    private $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function index()
    {
        return $this->sendResponse(new UserCollection($this->userService->getList()), "", 200);
    }

    public function store(Request $request)
    {
        $userArray = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password
        ];

        return $this->sendResponse(new UserResource($this->userService->store($userArray)), "", 201);
    }

    public function show($id)
    {
        return $this->sendResponse(new UserResource($this->userService->get($id)), "", 200);
    }

    public function getByEmail($email)
    {
        return $this->sendResponse(new UserResource($this->userService->getByEmail($email)), "", 200);
    }

    public function update(Request $request, $id)
    {
        $data = [
            "name" => $request->name
        ];
        return $this->sendResponse($this->userService->update($data, $id), "", 200);
    }

    public function delete($id)
    {
        return $this->sendResponse($this->userService->delete($id), "", 204);
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (!auth()->attempt($credentials)) {
            abort(401, 'Invalid Credentials');
        }

        $token = auth()->user()->createToken('auth_token');

        return $this->sendResponse(['token' => $token->plainTextToken], "", 200);
    }

    public function logout()
    {
        auth()->user()->currentAccessToken()->delete();

        return $this->sendResponse([], "", 204);
    }
}

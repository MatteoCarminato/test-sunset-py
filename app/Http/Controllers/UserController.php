<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Services\UserServices;

class UserController extends Controller
{
    private $userServices;
    public function __construct(UserServices $userServices) {
      $this->userServices = $userServices;
    }
    public function store(StoreUserRequest $request)
    {
        return $this->userServices->createUser($request->validated());
    }
}

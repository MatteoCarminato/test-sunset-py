<?php

namespace App\Http\Services;

use App\Http\Repositories\UserRepository;
use Illuminate\Support\Facades\DB;


class UserServices
{
    protected $userRepository;
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }
    public function createUser($payload)
    {
        return DB::transaction(function () use ($payload) {
            try {
                $userCreated = $this->userRepository->store($payload);
                //cadastrou o usuario, cria uma carteira pra ele
                
            } catch (\Exception $e) {
                return response()->json([
                    'success' => false,
                    'message' => $e->getMessage()
                ], 500);
            }
        });
    }
}
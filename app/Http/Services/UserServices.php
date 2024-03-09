<?php

namespace App\Http\Services;

use App\Http\Repositories\UserRepository;
use App\Http\Repositories\WalletRepository;
use Illuminate\Support\Facades\DB;


class UserServices
{
    protected $userRepository;
    protected $walletRepository;

    public function __construct(UserRepository $userRepository, WalletRepository $walletRepository)
    {
        $this->userRepository = $userRepository;
        $this->walletRepository = $walletRepository;
    }
    public function createUser($payload)
    {
        return DB::transaction(function () use ($payload) {
            try {

                $userCreated = $this->userRepository->store($payload);
                $wallet['user_id'] = $userCreated->id;
                $wallet['amount'] = $payload['amount'];

                $this->walletRepository->store($wallet);
                
            } catch (\Exception $e) {
                return response()->json([
                    'success' => false,
                    'message' => $e->getMessage()
                ], 500);
            }
        });
    }
}
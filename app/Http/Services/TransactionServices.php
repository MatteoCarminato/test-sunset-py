<?php

namespace App\Http\Services;

use App\Http\Repositories\TransactionRepository;
use Illuminate\Support\Facades\DB;


class TransactionServices
{
    protected $transactionRepository;

    public function __construct(TransactionRepository $transactionRepository)
    {
        $this->transactionRepository = $transactionRepository;
    }
    public function createTransaction($payload)
    {
        return DB::transaction(function () use ($payload) {
            try {

                // $transactionCreated = $this->transactionRepository->store($payload);
                // $wallet['transaction_id'] = $transactionCreated->id;
                // $wallet['amount'] = $payload['amount'];

                // $this->walletRepository->store($wallet);
                
            } catch (\Exception $e) {
                return response()->json([
                    'success' => false,
                    'message' => $e->getMessage()
                ], 500);
            }
        });
    }
}
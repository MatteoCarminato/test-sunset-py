<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTransactionRequest;
use App\Http\Services\TransactionServices;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    private $transactionServices;
    public function __construct(TransactionServices $transactionServices)
    {
        $this->transactionServices = $transactionServices;
    }
    public function store(StoreTransactionRequest $request)
    {
        return $this->transactionServices->createTransaction($request->validated());
    }
}

<?php

namespace App\Http\Services;

use App\Jobs\StoreTransaction;


class TransactionServices
{
  public function createTransaction($payload)
  {
    StoreTransaction::dispatch($payload['type'], $payload['value'], $payload['user_id']);
    return response()->json(['message' => 'Job dispatched successfully']);
  }
}
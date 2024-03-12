<?php

namespace Tests\Unit;

use App\Http\Controllers\TransactionController;
use App\Http\Requests\StoreTransactionRequest;
use App\Http\Services\TransactionServices;
use Illuminate\Http\JsonResponse;
use Mockery;
use PHPUnit\Framework\TestCase;

class TransactionTest extends TestCase
{
    /**
     * A basic unit test example.
     */
    public function test_store_transaction(): void
    {
      $transactionServices = Mockery::mock(TransactionServices::class);
      
      $controller = new TransactionController($transactionServices);

      $payload = [
          'type' => 'credit',
          'value' => 100,
          'user_id' => 1
      ];

      $request = Mockery::mock(StoreTransactionRequest::class);
      $request->shouldReceive('validated')->andReturn($payload);

      $transactionServices->shouldReceive('createTransaction')->with($payload)->andReturn(
          new JsonResponse(['message' => 'Transação em andamento'], 200)
      );

      $response = $controller->store($request);

      $this->assertInstanceOf(JsonResponse::class, $response);

      $responseData = $response->getData();
      $this->assertEquals('Transação em andamento', $responseData->message);
  }
}

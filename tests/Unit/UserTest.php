<?php

namespace Tests\Unit;

use App\Http\Controllers\UserController;
use App\Http\Requests\StoreUserRequest;
use App\Http\Services\UserServices;
use Illuminate\Http\JsonResponse;
use Mockery;
use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
    /**
     * A basic unit test example.
     */
    public function test_store_user(): void
    {
       $userServices = Mockery::mock(UserServices::class);
       $controller = new UserController($userServices);

       $payload = [
           'name' => 'Sunset',
           'amount' => 100
       ];
       $request = Mockery::mock(StoreUserRequest::class);
       $request->shouldReceive('validated')->andReturn($payload);

       $userCreated = (object) [
           'id' => 1,
           'name' => 'Sunset',
       ];
       $walletCreated = (object) [
           'id' => 1,
           'user_id' => 1,
           'amount' => 100
       ];
       $userServices->shouldReceive('createUser')->with($payload)->andReturn(
           new JsonResponse([
               'user' => $userCreated,
               'wallet' => $walletCreated
           ], 201)
       );

       $response = $controller->store($request);

       $this->assertInstanceOf(JsonResponse::class, $response);

       $responseData = $response->getData();
       $this->assertEquals($userCreated, $responseData->user);
       $this->assertEquals($walletCreated, $responseData->wallet);
   }

   public function test_store_user_fail()
    {
        $userServices = Mockery::mock(UserServices::class);
        
        $controller = new UserController($userServices);

        $payload = [
            'name' => 'Sunset Error',
            'amount' => 100
        ];

        $request = Mockery::mock(StoreUserRequest::class);
        $request->shouldReceive('validated')->andReturn($payload);

        $errorMessage = 'Failed to create user.';
        $userServices->shouldReceive('createUser')->with($payload)->andReturn(
            new JsonResponse([
                'success' => false,
                'message' => $errorMessage
            ], 500)
        );

        $response = $controller->store($request);

        $this->assertInstanceOf(JsonResponse::class, $response);

        $responseData = $response->getData();
        $this->assertFalse($responseData->success);
        $this->assertEquals($errorMessage, $responseData->message);
    }
}
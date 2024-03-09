<?php

namespace App\Http\Repositories;
use App\Models\Wallet;


class WalletRepository
{
  private $model;
  public function __construct(Wallet $model) {
    $this->model = $model;
  }

  public function store($data): Wallet
  {
    return $this->model->create($data);
  }
}
<?php

namespace App\Http\Repositories;
use App\Models\User;


class UserRepository
{
  private $model;
  public function __construct(User $model) {
    $this->model = $model;
  }

  public function store(array $data): User
  {
    return $this->model->create($data);
  }
}
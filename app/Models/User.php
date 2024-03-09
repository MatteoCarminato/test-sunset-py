<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'name'
    ];

    public function wallet()
    {
      return $this->hasOne(Wallet::class);
    }
}

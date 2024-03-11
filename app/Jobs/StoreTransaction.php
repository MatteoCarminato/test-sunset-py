<?php

namespace App\Jobs;

use App\Models\Transaction;
use App\Models\Wallet;
use Cache;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class StoreTransaction implements ShouldQueue
{
  use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

  private $type;
  private $value;
  private $user_id;
  /**
   * Create a new job instance.
   */
  public function __construct($type, $value, $user_id)
  {
    $this->type = $type;
    $this->value = $value;
    $this->user_id = $user_id;
  }

  /**
   * Execute the job.
   */
  public function handle(): void
  {
    \Log::info('Something is being processed...');
    $transaction = new Transaction();


    \DB::transaction(function () use ($transaction) {
      $transaction->type = $this->type;
      $transaction->value = $this->value;
      $transaction->user_id = $this->user_id;
      $transaction->type = 'credit';
      $transaction->save();

      if ($this->type == 'credit') {
        //Atualiza a carteira - crédito
        if (Cache::has('wallet_' . $this->user_id . '_key')) {
          $wallet_user = Cache::get('wallet_' . $this->user_id . '_key');
          $wallet_user->amount = $wallet_user->amount + $transaction->value;
          $wallet_user->save();
          Cache::put('wallet_' . $this->user_id . '_key', $wallet_user, 60);
        } else {
          $wallet = Wallet::where('user_id', $this->user_id)->first();
          $wallet_amount = $wallet->amount + $transaction->value;
          $wallet->save();
          Cache::put('wallet_' . $this->user_id . '_key', $wallet, 60);
        }
      } else {
        //Atualiza a carteira - débito
        if (Cache::has('wallet_' . $this->user_id . '_key')) {
          $wallet_user = Cache::get('wallet_' . $this->user_id . '_key');
          if ($wallet_user->amount >= $transaction->value) {
            $wallet_user->amount = $wallet_user->amount - $transaction->value;
            $wallet_user->save();
            Cache::put('wallet_' . $this->user_id . '_key', $wallet_user, 60);
          } else {
            \Log::error('Saldo insulficiente para o usuario: '. $this->user_id);
          }
        } else {
          $wallet = Wallet::where('user_id', $this->user_id)->first();
          if ($wallet->amount >= $transaction->value) {
            $wallet->amount = $wallet->amount - $transaction->value;
            $wallet->save();
            Cache::put('wallet_' . $this->user_id . '_key', $wallet, 60);
          } else {
            \Log::error('Saldo insulficiente para o usuario: '. $this->user_id);
          }
        }
      }
    });
  }
}

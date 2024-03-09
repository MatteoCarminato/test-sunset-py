<?php

namespace App\Jobs;

use App\Models\Transaction;
use App\Models\Wallet;
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
        //transacao de credito 

        //verifico se é entrada ou saida

        //se for entrada, eu crio a transacao e atualizo o saldo do usuario

        //se for saida , eu verifico o saldo da pessoa, primeiro olho se tem cache dela, caso não tenha, então faço uma consulta
        // na wallet passando o id da pessoa e verifico se ela tem saldo suficiente para fazer a transacao, caso tenha, 
        //eu crio a transacao e atualizo o saldo da pessoa e crio um cache pra ela
        //caso não tenha, eu retorno uma mensagem de erro
        
      
        $transaction = new Transaction();
        if ($this->type == 'credit') {

          return DB::transaction(function () use ($transaction) {
            $transaction->type = $this->type;
            $transaction->value = $this->value;
            $transaction->user_id = $this->user_id;
            $transaction->type = 'credit';
            $transaction->save();

            //verifica se tem cache do usuario
            if (Cache::has('key')) {
              $wallet = Cache::get('key');
            } else {
              $wallet = Wallet::where('user_id', $this->user_id)->first();
              Cache::put('key', $wallet, 60);
            }
          });



        } else {
            $transaction->value = -$this->value;
        }


    }
}

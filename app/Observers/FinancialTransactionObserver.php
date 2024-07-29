<?php

namespace App\Observers;

use App\Models\Financial_transaction;
use Auth;
use App\Models\Log;

class FinancialTransactionObserver
{
    public function created(Financial_transaction $transaction): void
    {
        $user_id =  Auth::user()->id ?? null;
        $user_name = $transaction->user->name ?? null;

        Log::create([
            'user_id' => $user_id,
            'action' => 'created',
            'action_id' => $transaction->id,
            'message' => " لقد قام " . $user_name . " بلاشتراك علي باقة " . $transaction->package->name,
            'action_model' => $transaction->getTable(),
        ]);
    }
}

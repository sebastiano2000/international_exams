<?php

namespace App\Observers;

use App\Models\Price;

use Auth;
use App\Models\Log;

class PriceObserver
{
    /**
     * Handle the Price "created" event.
     */
    public function created(Price $price): void
    {
        $user_id =  Auth::user()->id ?? null;

        Log::create([
            'user_id' => $user_id,
            'action' => 'created',
            'action_id' => $price->id,
            'message' => " لقد قام " . Auth::user()->name . " باضافة باقة جديدة " . $price->name,
            'action_model' => $price->getTable(),
        ]);
    }

    /**
     * Handle the Price "updated" event.
     */
    public function updated(Price $price): void
    {
        $user_id =  Auth::user()->id ?? null;

        Log::create([
            'user_id' => $user_id,
            'action' => 'updated',
            'action_id' => $price->id,
            'message' => " لقد قام " . Auth::user()->name . " بتعديل الباقة $price->name",
            'action_model' => $price->getTable(),
        ]);
    }

    /**
     * Handle the Price "deleted" event.
     */
    public function deleted(Price $price): void
    {
        $user_id =  Auth::user()->id ?? null;

        Log::create([
            'user_id' => $user_id,
            'action' => 'deleted',
            'action_id' => $price->id,
            'message' => " لقد قام " . Auth::user()->name . " بمسح الباقة $price->name ",
            'action_model' => $price->getTable(),
        ]);
    }
    /**
     * Handle the Price "force deleted" event.
     */
    public function forceDeleted(Price $price): void
    {
        //
    }
}

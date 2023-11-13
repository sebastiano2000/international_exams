<?php

namespace App\Providers;

use App\Models\Financial_transaction;
use App\Models\User;
use App\Models\Result;
use App\Models\UserFav;
use App\Models\UserResult;
use App\Models\UserTest;
use Illuminate\Support\ServiceProvider;
use App\Observers\UserObserver;
use App\Observers\ResultObserver;
use App\Observers\UserFavObserver;
use App\Observers\UserResultObserver;
use App\Observers\UserTestObserver;
use App\Observers\PriceObserver;
use App\Observers\FinancialTransactionObserver;
use App\Models\Price;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {

        User::observe(UserObserver::class);
        Result::observe(ResultObserver::class);
        UserFav::observe(UserFavObserver::class);
        UserResult::observe(UserResultObserver::class);
        UserTest::observe(UserTestObserver::class);
        Price::observe(PriceObserver::class);
        Financial_transaction::observe(FinancialTransactionObserver::class);
        app()->setLocale('ar');
    }
}

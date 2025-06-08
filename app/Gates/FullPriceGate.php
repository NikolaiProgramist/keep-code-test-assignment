<?php

namespace App\Gates;

use App\Models\Car;
use App\Models\User;
use Illuminate\Auth\Access\Response;
use Illuminate\Support\Facades\Gate;

class FullPriceGate
{
    public function register(): void
    {
        Gate::define('full-price-cash-enough', function (User $user, Car $car) {
            return $user->cash >= $car->full_price
                ? Response::allow()
                : Response::deny('There are not enough funds in your account to make a purchase.')
                    ->withStatus(403);
        });
    }
}

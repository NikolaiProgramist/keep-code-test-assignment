<?php

namespace App\Gates;

use App\Models\Car;
use App\Models\User;
use Illuminate\Auth\Access\Response;
use Illuminate\Support\Facades\Gate;

class CarGate
{
    public function register(): void
    {
        Gate::define('car-owner', function (User $user, Car $car) {
            return $user->id === optional($car->purchase)->user_id
                ? Response::allow()
                : Response::deny('You are not the owner of this car.')
                    ->withStatus(403);
        });

        Gate::define('car-not-purchased', function (User $user, Car $car) {
            return $car->purchased === 0
                ? Response::allow()
                : Response::deny('This car has already been purchased.')
                    ->withStatus(403);
        });
    }
}

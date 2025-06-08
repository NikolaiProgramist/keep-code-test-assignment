<?php

namespace App\Gates;

use App\Models\Car;
use App\Models\Purchase;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Auth\Access\Response;
use Illuminate\Support\Facades\Gate;

class RentGate
{
    public function register(): void
    {
        Gate::define('rent-hours-limit', function (User $user, Purchase $purchase, int $hours) {
            $leftHours = Carbon::createFromDate($purchase->expires_at)->timestamp - now()->timestamp;
            $newHours = Carbon::createFromTimestamp(0)->addHours($hours)->timestamp;
            $maxHours = Carbon::createFromTimestamp(0)->addHours(24)->timestamp;

            return $leftHours + $newHours <= $maxHours
                ? Response::allow()
                : Response::deny(
                    'The rent extension time in total with the current rent time cannot exceed 24 hours.'
                )->withStatus(403);
        });

        Gate::define('rent-price-cash-enough', function (User $user, Car $car, int $hours) {
            return $user->cash >= $hours * $car->rental_price
                ? Response::allow()
                : Response::deny('Not enough funds in the account to rent.')
                    ->withStatus(403);
        });
    }
}

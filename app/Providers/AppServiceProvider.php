<?php

namespace App\Providers;

use App\Models\Car;
use App\Models\Purchase;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Auth\Access\Response;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
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

        Gate::define('full-price-cash-enough', function (User $user, Car $car) {
            return $user->cash >= $car->full_price
                ? Response::allow()
                : Response::deny('There are not enough funds in your account to make a purchase.')
                    ->withStatus(403);
        });

        Gate::define('car-not-purchased', function (User $user, Car $car) {
            return $car->purchased === 0
                ? Response::allow()
                : Response::deny('This car has already been purchased.')
                    ->withStatus(403);
        });

        Gate::define('car-owner', function (User $user, Car $car) {
            return $user->id === optional($car->purchase)->user_id
                ? Response::allow()
                : Response::deny('You are not the owner of this car.')
                    ->withStatus(403);
        });

        Gate::define('purchase-rented', function (User $user, Purchase $purchase) {
            return $purchase->expires_at !== null
                ? Response::allow()
                : Response::deny(
                    'It is not possible to extend the rent for a purchase that has already been fully purchased.'
                )->withStatus(403);
        });

        Gate::define('purchase-owner', function (User $user, Purchase $purchase) {
            return $user->id === $purchase->user_id
                ? Response::allow()
                : Response::deny('You are not the owner of this purchase.')
                    ->withStatus(403);
        });

        Gate::define('is-admin', function (User $user) {
            return $user->role === 'admin'
                ? Response::allow()
                : Response::deny('You are not an administrator.')
                    ->withStatus(403);
        });

        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(40)->by($request->user()?->id ?: $request->ip())->response(
                function (Request $request, array $headers) {
                    return response()->json([
                        'message' => 'Too many attempts.'
                    ], 429);
                }
            );
        });
    }
}

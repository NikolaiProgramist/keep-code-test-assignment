<?php

namespace App\Services;

use App\Models\Car;
use App\Models\Purchase;
use Carbon\Carbon;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class RentPaymentService
{
    public function rent(Authenticatable $user, Car $car): JsonResponse
    {
        $hours = (int) request()->get('hours');
        $expiresAt = now()->addHours($hours);

        Gate::authorize('car-not-purchased', $car);
        Gate::authorize('rent-price-cash-enough', [$car, $hours]);

        DB::transaction(function () use ($user, $car, $hours, $expiresAt) {
            $user->cash = $user->cash - ($hours * $car->rental_price);
            $user->save();

            $purchase = $user->purchases()->make();
            $purchase->car_id = $car->id;
            $purchase->expires_at = $expiresAt;
            $purchase->save();

            $car->purchased = true;
            $car->save();
        });

        return response()->json([
            'message' => "Rent completed successfully. The car is rented until {$expiresAt}."
        ]);
    }

    public function extendRent(Authenticatable $user, Purchase $purchase): JsonResponse
    {
        $car = $purchase->car;
        $hours = (int) request()->get('hours');
        $newExpiresAt = Carbon::createFromDate($purchase->expires_at)->addHours($hours);

        Gate::authorize('purchase-owner', $purchase);
        Gate::authorize('purchase-rented', $purchase);
        Gate::authorize('rent-hours-limit', [$purchase, $hours]);
        Gate::authorize('rent-price-cash-enough', [$car, $hours]);

        DB::transaction(function () use ($user, $purchase, $car, $hours, $newExpiresAt) {
            $user->cash = $user->cash - ($hours * $car->rental_price);
            $user->save();

            $purchase->expires_at = $newExpiresAt;
            $purchase->save();
        });

        return response()->json([
            'message' => "Rent successfully extended. The car is rented until {$newExpiresAt}."
        ]);
    }
}

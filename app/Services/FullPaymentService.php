<?php

namespace App\Services;

use App\Models\Car;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class FullPaymentService
{
    public function full(Authenticatable $user, Car $car): JsonResponse
    {
        Gate::authorize('car-not-purchased', $car);
        Gate::authorize('full-price-cash-enough', $car);

        DB::transaction(function () use ($user, $car) {
            $user->cash = $user->cash - $car->full_price;
            $user->save();

            $purchase = $user->purchases()->make();
            $purchase->car_id = $car->id;
            $purchase->save();

            $car->purchased = true;
            $car->save();
        });

        return response()->json([
            'message' => 'Purchase completed successfully.'
        ]);
    }
}

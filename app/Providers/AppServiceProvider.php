<?php

namespace App\Providers;

use App\Gates\CarGate;
use App\Gates\FullPriceGate;
use App\Gates\PurchaseGate;
use App\Gates\RentGate;
use App\Gates\RoleGate;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
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
    public function boot(
        RoleGate $roleGate,
        CarGate $carGate,
        PurchaseGate $purchaseGate,
        RentGate $rentGate,
        FullPriceGate $fullPriceGate
    ): void
    {
        $roleGate->register();
        $carGate->register();
        $purchaseGate->register();
        $rentGate->register();
        $fullPriceGate->register();

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

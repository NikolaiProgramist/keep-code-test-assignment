<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\RentPurchaseRequest;
use App\Models\Car;
use App\Models\Purchase;
use App\Services\RentPaymentService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class RentPurchaseController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(RentPurchaseRequest $request, Car $car, RentPaymentService $service): JsonResponse
    {
        return $service->rent(Auth::user(), $car);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(RentPurchaseRequest $request, Purchase $purchase, RentPaymentService $service): JsonResponse
    {
        return $service->extendRent(Auth::user(), $purchase);
    }
}

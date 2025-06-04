<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\RentPurchaseRequest;
use App\Models\Car;
use App\Models\Purchase;
use App\Services\RentPaymentService;
use Illuminate\Support\Facades\Auth;

class RentPurchaseController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(RentPurchaseRequest $request, string $id, RentPaymentService $service)
    {
        return $service->rent(Auth::user(), Car::findOrFail($id));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(RentPurchaseRequest $request, string $id, RentPaymentService $service)
    {
        return $service->extendRent(Auth::user(), Purchase::findOrFail($id));
    }
}

<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePurchaseRequest;
use App\Http\Requests\UpdatePurchaseRequest;
use App\Http\Resources\Api\V1\PurchaseResource;
use App\Http\Resources\Api\V1\StatusPurchaseResource;
use App\Models\Purchase;
use App\Services\CodeService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class PurchaseController extends Controller
{
    /**
     * Display the status of the resource.
     */
    public function status(Request $request, Purchase $purchase, CodeService $service): StatusPurchaseResource
    {
        Gate::authorize('purchase-owner', $purchase);

        if ($purchase->code === null) {
            $service->generate($purchase);
        }

        return new StatusPurchaseResource($purchase);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): AnonymousResourceCollection
    {
        return PurchaseResource::collection(Auth::user()->purchases()->paginate(10));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePurchaseRequest $request): JsonResponse
    {
        return response()->json('This action is missing.', 403);
    }

    /**
     * Display the specified resource.
     */
    public function show(Purchase $purchase): PurchaseResource
    {
        Gate::authorize('purchase-owner', $purchase);
        return new PurchaseResource($purchase);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePurchaseRequest $request, Purchase $purchase): JsonResponse
    {
        return response()->json('This action is missing.', 403);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Purchase $purchase): JsonResponse
    {
        return response()->json('This action is missing.', 403);
    }
}

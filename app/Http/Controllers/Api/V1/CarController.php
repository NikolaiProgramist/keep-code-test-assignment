<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCarRequest;
use App\Http\Requests\UpdateCarRequest;
use App\Http\Resources\Api\V1\CarResource;
use App\Models\Car;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Gate;

class CarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): AnonymousResourceCollection
    {
        return CarResource::collection(Car::query()->where('purchased', 0)->paginate(10));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCarRequest $request): CarResource
    {
        Gate::authorize('is-admin');
        return new CarResource(Car::create($request->all()));
    }

    /**
     * Display the specified resource.
     */
    public function show(Car $car): CarResource
    {
        if (Gate::allows('car-owner', $car)) {
            return new CarResource($car);
        }

        Gate::authorize('car-not-purchased', $car);
        return new CarResource($car);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCarRequest $request, Car $car): CarResource
    {
        Gate::authorize('is-admin');
        $car->update($request->all());

        return new CarResource($car);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Car $car): Response
    {
        Gate::authorize('is-admin');
        $car->delete();

        return response(null, 204);
    }
}

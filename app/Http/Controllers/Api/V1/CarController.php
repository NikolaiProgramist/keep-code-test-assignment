<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCarRequest;
use App\Http\Requests\UpdateCarRequest;
use App\Models\Car;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Response;

class CarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Collection
    {
        return Car::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCarRequest $request): Car
    {
        return Car::create($request->all());
    }

    /**
     * Display the specified resource.
     */
    public function show(Car $car): Car
    {
        return $car;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCarRequest $request, Car $car): Car
    {
        $car->update($request->all());
        return $car;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Car $car): Response
    {
        $car->delete();
        return response(null, 204);
    }
}

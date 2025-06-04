<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Car;
use App\Services\FullPaymentService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FullPurchaseController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, string $id, FullPaymentService $service)
    {
        return $service->full(Auth::user(), Car::findOrFail($id));
    }
}

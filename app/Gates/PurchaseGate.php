<?php

namespace App\Gates;

use App\Models\Purchase;
use App\Models\User;
use Illuminate\Auth\Access\Response;
use Illuminate\Support\Facades\Gate;

class PurchaseGate
{
    public function register(): void
    {
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
    }
}

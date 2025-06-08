<?php

namespace App\Gates;

use App\Models\User;
use Illuminate\Auth\Access\Response;
use Illuminate\Support\Facades\Gate;

class RoleGate
{
    public function register(): void
    {
        Gate::define('is-admin', function (User $user) {
            return $user->role === 'admin'
                ? Response::allow()
                : Response::deny('You are not an administrator.')
                    ->withStatus(403);
        });
    }
}

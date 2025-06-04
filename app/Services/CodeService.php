<?php

namespace App\Services;

use App\Models\Purchase;
use Illuminate\Support\Str;

class CodeService
{
    public function generate(Purchase $purchase): string
    {
        $uuid = (string) Str::uuid();

        $purchase->code = $uuid;
        $purchase->save();

        return $uuid;
    }
}

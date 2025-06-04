<?php

use App\Models\Car;
use App\Models\Purchase;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Schedule::command('sanctum:prune-expired --hours=1')->everyMinute();

Schedule::call(function () {
    $expiresCarsId = Purchase::query()
        ->select('car_id')
        ->where('expires_at', '<=', now())
        ->get();

    Car::query()->whereIn('id', $expiresCarsId)->update(['purchased' => false]);

    Purchase::query()
        ->where('expires_at', '<=', now())
        ->delete();
})->everyMinute();

<?php

use App\Models\Product;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

/*
|--------------------------------------------------------------------------
| Console Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of your Closure based console
| commands. Each Closure is bound to a command instance allowing a
| simple approach to interacting with each command's IO methods.
|
*/

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');


Artisan::command('created_products', function () {
    Product::factory()->create();
});

Artisan::command('updated_products', function () {
    Product::query()->first()->update(['name' => 'updated']);
});

Artisan::command('deleted_products', function () {
    Product::query()->first()->delete();
});
<?php

use App\Models\Product;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\Middleware\Authorize;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;

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

Artisan::command('check:db', function () {
    Artisan::call('cache:clear');
    $this->comment(env('DB_DATABASE'));
    $this->comment(env('DB_HOST'));
    $this->comment(env('DB_PORT'));
    $this->comment(env('DB_USERNAME'));
    $this->comment(env('DB_PASSWORD'));
    dd(DB::connection()->getPdo());    
})->describe('Check db');

//create commands check db test
Artisan::command('check:db-test', function () {
    Artisan::call('cache:clear');
    $this->comment(env('DB_TEST_DATABASE'));
    $this->comment(env('DB_TEST_HOST'));
    $this->comment(env('DB_TEST_PORT'));
    $this->comment(env('DB_TEST_USERNAME'));
    $this->comment(env('DB_TEST_PASSWORD'));
    dd(DB::connection()->getPdo());    
})->describe('Check db');

//create commands check db test
Artisan::command('exception:auth', function () {
   // throw new Exception('error exception');
    throw new AuthorizationException();
});
Artisan::command('exception:error', function () {
    // throw new Exception('error exception');
     throw new Exception('test error exception');
 });
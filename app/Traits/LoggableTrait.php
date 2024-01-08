<?php
namespace App\Traits;

use App\Observers\LoggableObserver;

trait LoggableTrait
{
    public static function bootLoggableTrait()
    {
        static::observe(LoggableObserver::class);
    }
}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Observers\LoggableObserver;

class BaseModel extends Model
{
    public static function boot()
    {
        parent::boot();

        static::observe(LoggableObserver::class);
    }
}

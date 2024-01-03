<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use \App\Traits\Loggable;

class Product extends Model
{
    use HasFactory;
    use Loggable;

    protected $fillable = [
        'name',
        'price',
    ];
}

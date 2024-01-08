<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use \App\Traits\LoggableTrait;

class Product extends Model
{
    use HasFactory;
    use LoggableTrait;

    protected $fillable = [
        'name',
        'price',
    ];
}

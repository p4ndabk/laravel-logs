<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'event_type',
        'model_id',
        'table_name',
        'old_data',
        'new_data',
        'diff_data',
    ];
}

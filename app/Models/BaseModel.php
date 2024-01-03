<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Loggable;

class BaseModel extends Model
{
    use Loggable;
}

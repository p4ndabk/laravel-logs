<?php 

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Support\Facades\Validator as ValidatorBuilder;

class UserFilter extends AbstractFilter
{
    public function validate(): Validator
    {
        return ValidatorBuilder::make($this->values, [
           'id' => 'nullable|int',
           'name' => 'nullable|string'
        ]);
    }

   public function applyId(Builder $builder, int $id)    
    {       
        $builder->where('id', $id);  
    }

   public function applyName(Builder $builder, string $id)    
    {       
        $builder->where('name', $id);  
    }
}

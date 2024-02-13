<?php 

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Support\Facades\Validator as ValidatorBuilder;

class ClientFilter extends AbstractFilter
{
    public function validate(): Validator
    {
        return ValidatorBuilder::make($this->values, [
           'id' => 'nullable|array',
           'name' => 'nullable|string',
           'price' => 'nullable|numeric'
        ]);
    }

    public function applyId(Builder $builder, $value)    
    {       
        $builder->whereIn('id', $value);  
    }

    public function applyName(Builder $builder, $value)    
    {       
        $builder->where('name', 'like', '%'.$value.'%');  
    }

    public function applyPrice(Builder $builder, $value)    
    {       
        $builder->where('price', '>=', $value);  
    }
}

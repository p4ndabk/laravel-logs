<?php 

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Support\Facades\Validator as ValidatorBuilder;

class ProductsFilter extends AbstractFilter
{
    public function validate(): Validator
    {
        return ValidatorBuilder::make($this->values, [
           'id' => 'nullable|int',
           'name' => 'nullable|string',
           'price' => 'nullable|numeric'
        ]);
    }

    public function applyId(Builder $builder, $value)    
    {       
        $builder->where('id', '=', $value);  
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

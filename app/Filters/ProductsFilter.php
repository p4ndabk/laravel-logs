<?php 

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Support\Facades\Validator as ValidatorBuilder;


class ProductsFilter extends AbstractFilter
{
    function validate(): Validator
    {
        return ValidatorBuilder::make($this->values, [
            'id' => 'nullable|integer',
        ]);
    }

    public function applyId(Builder $builder, int $id)
    {
        $builder->where('id', $id);
    }

    public function applyName(Builder $builder, string $name)
    {
        $builder->where('name', 'like', '%' . $name . '%');
    }
}
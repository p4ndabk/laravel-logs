<?php


namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Contracts\Validation\Validator;

abstract class AbstractFilter
{
    protected $values = [];

    public function __construct(array $values)
    {
        $this->values = $values;
    }

    abstract function validate(): Validator;

    public function getValues(): array
    {
        return $this->values;
    }

    /**
     * @param Builder $query
     * @param Model|null $model
     * @return mixed
     */
    public function apply(Builder $builder)
    {
        $validator = $this->validate();
        $values = collect($validator->validate());

        foreach ($values as $name => $value) {
            if ($value === null) {
                continue;
            }

            $methodName = sprintf('apply%s', Str::camel($name));
            $callableFilter = [$this, $methodName];

            if (!is_callable($callableFilter)) {
                continue;
            }

            call_user_func_array($callableFilter, [$builder, $value]);
        }
    }
}

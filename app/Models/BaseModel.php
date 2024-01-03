<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BaseModel extends Model
{
    protected static function booted(): void
    {
        static::created(function ($model, $event = 'created') {
            self::saveLog(self::formatLog($event, $model));            
        });

        static::updated(function ($model, $event = 'updated') {
            self::saveLog(self::formatLog($event, $model));                      
        });

        static::deleted(function ($model, $event = 'deleted') {
            self::saveLog(self::formatLog($event, $model));                      
        });
    }

    private static function formatLog($event, $model)
    {
        return [
            'user_id' => 1, //pensa em como passar o usuario logado
            'event_type' => $event,
            'model_id' => $model->getKey(),
            'table_name' => $model->getTable(),
            'old_data' => json_encode($model->getOriginal() ?? []),
            'new_data' => json_encode($model->toArray() ?? []),
            'diff_data' => json_encode(self::getModelDiff($model))
        ];
    }

    private static function saveLog($data)
    {
        //save in database
        dump($data);
    }

    private static function getModelDiff($model)
    {
        return $model->getOriginal() ?
            array_diff($model->toArray(), $model->getOriginal())
            : [];
    }

}

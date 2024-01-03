<?php

namespace App\Traits;

trait Loggable
{
    protected static function bootLoggable(): void
    {
        static::created(function ($model) {
            self::saveLog(self::formatLog('created', $model));
        });

        static::updated(function ($model) {
            self::saveLog(self::formatLog('updated', $model));
        });

        static::deleted(function ($model) {
            self::saveLog(self::formatLog('deleted', $model));
        });
    }

    private static function formatLog($event, $model)
    {
        return [
            'user_id' => auth()->id(), // Pega o ID do usuário autenticado
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
        dump($data);
    }

    private static function getModelDiff($model)
    {
        return $model->getOriginal() ?
            array_diff($model->toArray(), $model->getOriginal())
            : [];
    }
}

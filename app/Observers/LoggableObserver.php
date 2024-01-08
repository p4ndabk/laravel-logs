<?php

namespace App\Observers;
use App\Models\Log;
use Illuminate\Support\Facades\Log as FacadesLog;

class LoggableObserver
{
    const EVENT_CREATED = 'created';
    const EVENT_UPDATED = 'updated';
    const EVENT_DELETED = 'deleted';

    public function created($model)
    {
        self::saveLog(self::formatLog(self::EVENT_CREATED, $model));
    }

    public function updated($model)
    {
        self::saveLog(self::formatLog(self::EVENT_UPDATED, $model));
    }

    public function deleted($model)
    {
        self::saveLog(self::formatLog(self::EVENT_DELETED, $model));
    }

    private static function formatLog($event, $model)
    {
        return [
            'user_id' => auth()->id() ?? null,
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
        try {
            Log::create($data);
        } catch (\Exception $e) {
            FacadesLog::debug('error' . $e->getMessage() . '|' . $e->getFile() . '|' . $e->getLine());
        }       
    }

    private static function getModelDiff($model)
    {
        return $model->getOriginal() ?
            array_diff($model->toArray(), $model->getOriginal())
            : [];
    }
}

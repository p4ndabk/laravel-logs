<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Artisan;
use App\Console\Kernel;
use Illuminate\Support\Facades\DB;

abstract class TestCase extends BaseTestCase
{
    use RefreshDatabase;
    use CreatesApplication;

    public function createApplication()
    {
        $createApp = function () {
            $app = require __DIR__ . '/../bootstrap/app.php';
            $app->make(Kernel::class)->bootstrap();

            return $app;
        };

        $app = $createApp();
        if ($app->environment() !== 'testing') {
            $this->clearCache();
            $app = $createApp();
        }

        if ($app->environment() !== 'testing')
        {
            throw new \Exception('The environment is not testing');
        }
        if (DB::connection()->getConfig('database') !== 'laravel_logs_test')
        {
            throw new \Exception('The database is not is not test');
        }
        
        return $app;
    }

    protected function clearCache()
    {
        $commands = ['clear-compiled', 'cache:clear', 'view:clear', 'config:clear', 'route:clear'];
        foreach ($commands as $command) {
            Artisan::call($command);
        }
    }
}

<?php

namespace App\Console\Commands;

use Illuminate\Support\Facades\File;
use Illuminate\Console\Command;
use Illuminate\Support\Str;

class MakeFilterCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:filter {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $filters = [
            'id' => 'nullable|int|=',
            'name' => 'nullable|string|like',
            'price' => 'nullable|numeric|>=',
        ];

        $name = $this->argument('name');
        $content = $this->openFile();
        $content = $this->replaceContent($content, $name, $filters);
        $this->createFile($name, $content);
    }

    public function openFile (): string
    {
        return File::get(public_path('input/Filter.txt'));
    }

    public function replaceContent (string $content, string $name, array $filters): string
    {
        $className = ucfirst($name)."Filter";
        $validator = $this->makeValidator($filters);
        $apply = $this->makeApply($filters);

        $content = str_replace('{{class_name}}', $className, $content);
        $content = str_replace('{{validator}}', $validator, $content);
        $content = str_replace('{{apply}}', $apply, $content);

        return $content;
    }

    public function makeValidator(array $filters): string
    {
        $validatorArray = [];

        foreach ($filters as $key => $value) {
            $lastBarPosition = strrpos($value, '|');
            if ($lastBarPosition !== false) {
                $value = substr($value, 0, $lastBarPosition);
            }

            $validatorArray[] = "           '$key' => '$value'";
        }

        $validatorString = "[\n" . implode(",\n", $validatorArray) . "\n        ]";

        return $validatorString;
    }


    public function makeApply (array $filters): string
    {
        $applyArray = [];

        foreach ($filters as $key => $value) {
            $params = explode('|', $value)[2];
            switch ($params) {
                case 'like':
                    $params = "'".explode('|', $value)[2]. "', " . "'%'.\$value.'%'";
                break;
                default:
                    $params = "'".explode('|', $value)[2]. "'" . ", \$value";
            }

            $applyArray[] = "    public function apply".ucfirst($key)."(Builder \$builder, \$value)    
    {       
        \$builder->where('$key', $params);  
    }";
        }

        return implode("\n\n", $applyArray);
    }

    public function createFile (string $name, string $content): void
    {
        $filename = ucfirst($name)."Filter.php";
        File::put(app_path("Filters/".$filename), $content);
    }
}

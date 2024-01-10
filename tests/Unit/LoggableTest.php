<?php

namespace Tests\Unit;

use App\Models\Log;
use Tests\TestCase;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LoggableTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic unit test example.
     */
    public function test_create_log_by_product(): void
    {
        $produto = Product::factory()->create();

        $log = Log::query();

        $this->assertEquals(1, $log->count());
        $this->assertEquals('created', $log->first()->event_type);
        $this->assertEquals('products', $log->first()->table_name);
        $this->assertEquals($produto->id, $log->first()->model_id);
        $this->assertEquals(json_encode($produto->toArray()), $log->first()->new_data);
        $this->assertEquals(json_encode([]), $log->first()->old_data);
        $this->assertEquals(json_encode([]), $log->first()->diff_data);        
    }

    public function test_update_log_by_product(): void
    {
        $produto = Product::factory()->create();

        $produto->update(['name' => 'updated']);

        $log = Log::query();

        $this->assertEquals(2, $log->count());

        $log = $log->orderByDesc('id')->first();
        $this->assertEquals('updated', $log->event_type);
        $this->assertEquals('products', $log->table_name);
        $this->assertEquals($produto->id, $log->model_id);
        $this->assertEquals(json_encode($produto->toArray()), $log->new_data);
        $this->assertEquals('updated', json_decode($log->diff_data)->name);        
    }

    public function test_delete_log_by_product(): void
    {
        $produto = Product::factory()->create();

        $produto->delete();

        $log = Log::query();

        $this->assertEquals(2, $log->count());

        $log = $log->orderByDesc('id')->first();
        $this->assertEquals('deleted', $log->event_type);
        $this->assertEquals('products', $log->table_name);
        $this->assertEquals($produto->id, $log->model_id);
    }
}

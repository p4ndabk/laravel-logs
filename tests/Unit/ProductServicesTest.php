<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Product;
use App\Services\ProductService;
use Illuminate\Validation\ValidationException;

class ProductServicesTest extends TestCase
{
    protected $service;

    public function setUp(): void
    {
        parent::setUp();
        $this->service = new ProductService();
    }
    
    public function test_get_all_products(): void
    {
        Product::factory()->count(2)->create();

        $products = $this->service->getProducts();

        $this->assertCount(2, $products);
    }

    public function test_filter_products_by_id(): void
    {
        Product::factory()->count(2)->create();

        $products = $this->service->getProducts(['id' => 1]);

        $this->assertCount(1, $products);
    }

    public function test_filter_products_validated_string_id(): void
    {
        $this->expectException(ValidationException::class);

        Product::factory()->count(2)->create();

        $this->service->getProducts(['id' => "abc"]);
    }
}

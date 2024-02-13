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
        $products = Product::factory()->count(4)->create()->pluck('id')->toArray();

        $products = $this->service->getProducts(['id' => [$products[0], $products[1]]]);
        $this->assertCount(2, $products);
    }

    public function test_filter_products_name_id(): void
    {
        Product::factory()->count(2)->create();

        Product::factory()->count(1)->create([
            'name' => 'Product 1'
        ]);

        Product::factory()->count(1)->create([
            'name' => 'Product 2'
        ]);

        $products = $this->service->getProducts(['name' => 'product']);

        $this->assertCount(2, $products);
    }

    //create test price
    public function test_filter_products_price_id(): void
    {
        Product::factory()->count(2)->create([
            'price' => 9
        ]);

        Product::factory()->count(1)->create([
            'price' => 10
        ]);

        Product::factory()->count(1)->create([
            'price' => 20
        ]);

        $products = $this->service->getProducts(['price' => 10]);

        $this->assertCount(2, $products);
    }

    public function test_filter_products_validated_string_id(): void
    {
        $this->expectException(ValidationException::class);

        Product::factory()->count(2)->create();

        $this->service->getProducts(['id' => "abc"]);
    }
}

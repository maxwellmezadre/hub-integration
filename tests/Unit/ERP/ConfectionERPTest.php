<?php

use App\Services\ERP\ConfectionERPService;
use Tests\TestCase;

class ConfectionERPTest extends TestCase
{
    public function test_it_can_get_products()
    {
        $service = new ConfectionERPService();
        $products = $service->getProducts();

        $this->assertIsArray($products);
    }

    public function test_it_can_get_variations()
    {
        $service = new ConfectionERPService();
        $variations = $service->getVariations();

        $this->assertIsArray($variations);
    }
}

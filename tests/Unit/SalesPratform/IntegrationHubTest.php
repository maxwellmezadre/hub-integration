<?php

use App\Integration\SalesPlatform\IntegrationHub;
use App\Services\ERP\ConfectionERPService;
use App\Transformers\SalesPlatform\ProductsConfectionERPTransformer;
use Tests\TestCase;

class IntegrationHubTest extends TestCase
{
    public function test_it_can_sync_products()
    {
        $erpService = Mockery::mock(ConfectionERPService::class);
        $productsTransformer = Mockery::mock(ProductsConfectionERPTransformer::class);

        $integrationHub = new IntegrationHub($erpService, $productsTransformer);

        $integrationHub->syncProducts();
    }
}

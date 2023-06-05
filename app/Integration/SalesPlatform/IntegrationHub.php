<?php

namespace App\Integration\SalesPlatform;

use App\Services\ERP\ERPService;
use App\Services\SalesPlatform\SalesPlatformService;
use App\Transformers\SalesPlatform\ProductsTransformer;
use Exception;

class IntegrationHub
{
    private ERPService $erpService;
    private ProductsTransformer $productsTransformer;
    private SalesPlatformService $salesPlatformService;

public function __construct(
        ERPService $erpService,
        ProductsTransformer $productsTransformer
    ) {
        $this->erpService = $erpService;
        $this->productsTransformer = $productsTransformer;
        $this->salesPlatformService = new SalesPlatformService();
    }

    public function syncProducts(): bool
    {
        $products = $this->erpService->getProducts();
        $variations = $this->erpService->getVariations();
        $products = $this->productsTransformer->transform($products, $variations);

        $products = array_chunk($products, 100);
        foreach ($products as $chunk) {
            $response = $this->salesPlatformService->registerProducts($chunk);

            if (!$response['result']['success']) {
                throw new Exception($response['result']['messages']);
            }
        }

        return true;
    }
}

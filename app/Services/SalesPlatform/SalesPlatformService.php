<?php

namespace App\Services\SalesPlatform;

use Exception;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;

class SalesPlatformService
{
    private PendingRequest $service;

    public function __construct()
    {
        if (!env('SALES_PLATFORM_API_KEY')) {
            throw new Exception('Sales Platform API Key not found');
        }

        if (!env('SALES_PLATFORM_URL')) {
            throw new Exception('Sales Platform URL not found');
        }

        if (!env('SALES_PLATFORM_COMPANY_ID')) {
            throw new Exception('Sales Platform Company ID not found');
        }

        $this->service = Http::withHeaders([
            'apikey' => env('SALES_PLATFORM_API_KEY'),
            'Content-Type' => 'application/json',
        ]);
    }

    public function registerProducts(array $products): array
    {
        $url = env('SALES_PLATFORM_URL') . '/v1/products/company/' . env('SALES_PLATFORM_COMPANY_ID');

        $response = $this->service->post($url, [
            'products' => $products,
        ]);

        return $response->json();
    }
}

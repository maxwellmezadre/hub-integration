<?php

namespace App\Services\ERP;

class ConfectionERPService implements ERPService
{
    public function getProducts(): array
    {
        $json = file_get_contents(base_path('database/data/products.json'));
        return json_decode($json, true);
    }

    public function getVariations(): array
    {
        $json = file_get_contents(base_path('database/data/variations.json'));
        return json_decode($json, true);
    }
}

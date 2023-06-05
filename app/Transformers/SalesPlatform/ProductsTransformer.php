<?php

namespace App\Transformers\SalesPlatform;

interface ProductsTransformer
{
    public function transform(array $product, array $variations): array;
}

<?php

namespace App\Transformers\SalesPlatform;

interface ProductTransformer
{
    public function transform(array $product, array $variations): array;
}

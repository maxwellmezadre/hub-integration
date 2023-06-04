<?php

namespace App\Transformers\SalesPlatform;

use App\Helpers\FormatterHelper;
use Illuminate\Support\Arr;

class ProductConfectionERPTransformer implements ProductTransformer
{
    public function transform(array $product, array $variations): array
    {
        $variations = Arr::where($variations, function ($variation) use ($product) {
            return explode('_', $variation['variacao'])[0] == $product['referencia'];
        });

        $variations = Arr::map($variations, function ($variation) {
            return [
                "sku" => $variation['variacao'],
                "size" => $variation['tamanho'],
                "color" => $variation['cor'],
                "quantity" => $variation['quantidade'],
                "order" => $variation['ordem'],
                "unit_type" => $variation['unidade'],
            ];
        });

        return [
            "integration_id" => $product['referencia'],
            "code" => $product['referencia'],
            "name" => $product['nome'],
            "active" => true,
            "description" => $product['descricao'],
            "composition" => $product['composicao'],
            "brand" => $product['marca'],
            "price" => FormatterHelper::moneyToDecimal($product['preco']),
        ];
    }
}

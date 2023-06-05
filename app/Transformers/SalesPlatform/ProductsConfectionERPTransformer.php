<?php

namespace App\Transformers\SalesPlatform;

use App\Helpers\FormatterHelper;

class ProductsConfectionERPTransformer implements ProductsTransformer
{
    public function transform(array $products, array $variations): array
    {
        $productsTransformed = [];

        foreach ($products as $product) {

            $variationsTrasformed = [];

            foreach ($variations as $key => $variation) {
                if (explode('_', $variation['variacao'])[0] == $product['referencia']) {
                    $variationsTrasformed[] = [
                        "sku" => $variation['variacao'],
                        "size" => $variation['tamanho'],
                        "color" => $variation['cor'],
                        "quantity" => $variation['quantidade'],
                        "order" => $variation['ordem'],
                        "unit_type" => $variation['unidade'],
                    ];

                    unset($variations[$key]);
                }
            }

            $productsTransformed[] = [
                "integration_id" => $product['referencia'],
                "code" => $product['referencia'],
                "name" => $product['nome'],
                "active" => true,
                "description" => $product['descricao'],
                "composition" => $product['composicao'],
                "brand" => $product['marca'],
                "price" => FormatterHelper::moneyToDecimal($product['preco']),
                "variations" => $variationsTrasformed,
            ];
        }

        return $productsTransformed;
    }
}

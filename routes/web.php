<?php

use Illuminate\Support\Facades\Route;
use App\Services\ERP\ConfectionERPService;
use App\Integration\SalesPlatform\IntegrationHub;
use App\Transformers\SalesPlatform\ProductsConfectionERPTransformer;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/produtos', function () {
    $service = new ConfectionERPService();
    $products = $service->getProducts();

    dump($products);
});

Route::get('/variacoes', function () {
    $service = new ConfectionERPService();
    $variations = $service->getVariations();

    dump($variations);
});

Route::get('/integracao', function () {
    $integrationHub = new IntegrationHub(
        new ConfectionERPService(),
        new ProductsConfectionERPTransformer()
    );

    try {
        if ($integrationHub->syncProducts()) {
            echo 'Products synced successfully!';
        }
    } catch (Exception $e) {
        echo $e->getMessage();
    }
});

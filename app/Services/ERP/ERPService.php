<?php

namespace App\Services\ERP;

interface ERPService
{
    public function getProducts(): array;
    public function getVariations(): array;
}

<?php

declare(strict_types=1);

namespace OrderManagement\Admin\Infrastructure\Manager;

use OrderManagement\Admin\Domain\Entities\Product;

class ProductManager
{
    public function create(Product $product): void
    {
        $model = new \App\Models\Product();
        $model->name = $product->name;
        $model->price = $product->price;
        $model->save();
    }

    public function update(int $productId, Product $product): void
    {
        $model = \App\Models\Product::findOrFail($productId);
        $model->name = $product->name;
        $model->price = $product->price;
        $model->save();
    }
}

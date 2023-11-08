<?php

namespace App\ValueObjects;

use App\Models\Product;
use Closure;
use Illuminate\Support\Collection;

/**
 *
 */
class Cart
{
    /**
     * @var Collection
     */
    private Collection $items;

    /**
     * @param Collection|null $items
     */
    public function __construct(Collection $items = null)
    {
        $this->items = $items ?? Collection::empty();
    }

    /**
     * @return Collection
     */
    public function getItems(): Collection
    {
        return $this->items;
    }

    /**
     * @param Product $product
     * @return Cart
     */
    public function addItem(Product $product): Cart
    {
        $items = $this->items;
        $item = $items->first($this->isProductIdSameAsItemProduct($product));
        if (!is_null($item)) {
            $items = $this->removeItemFromCart($items, $product);
            $newItem = $item->addQuantity($product);
        } else {
            $newItem = new CartItem($product);
        }
        $items->add($newItem);
        return new Cart($items);
    }

    /**
     * @return float
     */
    public function getSum(): float
    {
        return $this->items->sum(function ($item){
            return $item->getSum();
        });
    }

    /**
     * @return int
     */
    public function getQuantity(): int
    {
        return $this->items->sum(function ($item){
            return $item->getQuantity();
        });
    }

    /**
     * @return bool
     */
    public function hasItems(): bool
    {
        return $this->items->isNotEmpty();
    }

    /**
     * @param Product $product
     * @return Cart
     */
    public function removeItem(Product $product): Cart
    {
        $items = $this->removeItemFromCart($this->items,$product);
        return new Cart($items);
    }

    /**
     * @param Collection $items
     * @param Product $product
     * @return Collection
     */
    public function removeItemFromCart(Collection $items, Product $product): Collection
    {
        return $items->reject($this->isProductIdSameAsItemProduct($product));
    }

    /**
     * @param Product $product
     * @return Closure
     */
    public function isProductIdSameAsItemProduct(Product $product): Closure
    {
        return function ($item) use ($product) {
            return $product->id == $item->getProductId();
        };
    }

}

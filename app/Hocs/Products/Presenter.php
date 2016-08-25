<?php

namespace Nht\Hocs\Products;

class Presenter {

    protected $product;

    public function __construct(Product $product)
    {
        $this->product = $product;
    }

    public function getPrice() {
        return formatCurrency($this->product->getPrice());
    }
}
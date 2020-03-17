<?php

namespace Acme\Product;

interface Product
{
    public function getCode(): string;

    public function getPrice(): float;
}

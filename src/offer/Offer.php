<?php

namespace Acme\Offer;

interface Offer
{
    public function getDiscount(array $items): float;
}

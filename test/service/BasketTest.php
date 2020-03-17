<?php

namespace Acme\Test\Service;

use Acme\Service\Basket;
use PHPUnit\Framework\TestCase;

class BasketTest extends TestCase
{
    public function testInitialization(): void
    {
        $basket = new Basket();

        $this->assertInstanceOf(Basket::class, $basket);
    }
}

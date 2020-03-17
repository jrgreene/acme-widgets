<?php

namespace Acme\Test\Service;

use Acme\Offer\Offer;
use Acme\Product\Product;
use Acme\Rule\Rule;
use Acme\Service\Basket;
use PHPUnit\Framework\TestCase;

class BasketTest extends TestCase
{
    public function testInitialization(): void
    {
        $basket = new Basket();

        $this->assertInstanceOf(Basket::class, $basket);
    }

    public function testInitializationWithProducts(): void
    {
        $product1 = $this->createMock(Product::class);
        $product2 = $this->createMock(Product::class);

        $products = [
            $product1,
            $product2,
        ];

        $basket = new Basket($products);

        $returnedProducts = $basket->getProducts();

        $this->assertIsArray($returnedProducts);
        $this->assertCount(2, $returnedProducts);
        $this->assertEquals($product1, $returnedProducts[0]);
        $this->assertEquals($product1, $returnedProducts[1]);
    }

    public function testInitializationWithRules(): void
    {
        $rule1 = $this->createMock(Rule::class);
        $rule2 = $this->createMock(Rule::class);

        $rules = [
            $rule1,
            $rule2,
        ];

        $basket = new Basket([], $rules);

        $returnedRules = $basket->getRules();

        $this->assertIsArray($returnedRules);
        $this->assertCount(2, $returnedRules);
        $this->assertEquals($rule1, $returnedRules[0]);
        $this->assertEquals($rule2, $returnedRules[1]);
    }

    public function testInitializationWithOffers(): void
    {
        $offer1 = $this->createMock(Offer::class);
        $offer2 = $this->createMock(Offer::class);

        $offers = [
            $offer1,
            $offer2,
        ];

        $basket = new Basket([], [], $offers);

        $returnedRules = $basket->getOffers();

        $this->assertIsArray($returnedRules);
        $this->assertCount(2, $returnedRules);
        $this->assertEquals($offer1, $returnedRules[0]);
        $this->assertEquals($offer2, $returnedRules[1]);
    }
}

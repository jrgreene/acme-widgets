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
        $product1 = $this->getMockBuilder(Product::class)
                         ->setMockClassName('RedWidget')
                         ->setMethods(['getCode'])
                         ->getMock();

        $product1->expects($this->any())
                 ->method('getCode')
                 ->will($this->returnValue('R01'));

        $product2 = $this->getMockBuilder(Product::class)
                         ->setMockClassName('GreenWidget')
                         ->setMethods(['getCode'])
                         ->getMock();

        $product2->expects($this->any())
                 ->method('getCode')
                 ->will($this->returnValue('G01'));

        $products = [
            $product1,
            $product2,
        ];

        $basket = new Basket($products);

        $returnedProducts = $basket->getProducts();

        $this->assertIsArray($returnedProducts);
        $this->assertCount(2, $returnedProducts);
        $this->assertEquals($product1, $returnedProducts['R01']);
        $this->assertEquals($product2, $returnedProducts['G01']);
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

    public function testAdd(): void
    {
        $product1 = $this->getMockBuilder(Product::class)
                         ->setMockClassName('RedWidget')
                         ->setMethods(['getCode'])
                         ->getMock();

        $product1->expects($this->any())
                 ->method('getCode')
                 ->will($this->returnValue('R01'));

        $products = [
            $product1,
        ];

        $basket = new Basket($products);

        $basket->add('R01');

        $returnedItems = $basket->getItems();

        $this->assertIsArray($returnedItems);
        $this->assertCount(1, $returnedItems);
        $this->assertEquals($product1, $returnedItems[0]);
    }

    public function testAddBadProduct(): void
    {
        $this->expectExceptionMessage('Product with code R01 not in product catalogue.');

        $basket = new Basket();

        $basket->add('R01');
    }
}

<?php

namespace Acme\Service;

use Acme\Offer\Offer;
use Acme\Product\Product;
use Acme\Rule\Rule;

class Basket
{
    /** @var Product[] */
    private $products;

    /** @var Rule[] */
    private $rules;

    /** @var Offer[] */
    private $offers;

    /**
     * Basket constructor.
     * @param Product[] $products
     * @param Rule[] $rules
     * @param Offer[] $offers
     */
    public function __construct(array $products = [], array $rules = [], array $offers = [])
    {
        $this->setProducts($products);
        $this->setRules($rules);
        $this->setOffers($offers);
    }

    public function addProduct(Product $product): Basket
    {
        $this->products[] = $product;
        return $this;
    }

    /**
     * @return Product[]
     */
    public function getProducts(): array
    {
        return $this->products;
    }

    /**
     * @param Product[] $products
     * @return Basket
     */
    public function setProducts(array $products): Basket
    {
        $this->products = [];

        foreach ($products as $product) {
            $this->addProduct($product);
        }

        return $this;
    }

    public function addRule(Rule $rule): Basket
    {
        $this->rules[] = $rule;
        return $this;
    }

    /**
     * @return Rule[]
     */
    public function getRules(): array
    {
        return $this->rules;
    }

    /**
     * @param Rule[] $rules
     * @return Basket
     */
    public function setRules(array $rules): Basket
    {
        $this->rules = [];

        foreach ($rules as $rule) {
            $this->addRule($rule);
        }

        return $this;
    }

    public function addOffer(Offer $offer): Basket
    {
        $this->offers[] = $offer;
        return $this;
    }

    /**
     * @return Offer[]
     */
    public function getOffers(): array
    {
        return $this->offers;
    }

    /**
     * @param Offer[] $offers
     * @return Basket
     */
    public function setOffers(array $offers): Basket
    {
        $this->offers = [];

        foreach ($offers as $offer) {
            $this->addOffer($offer);
        }

        return $this;
    }
}

<?php

namespace Acme\Service;

use Acme\Offer\Offer;
use Acme\Product\Product;
use Acme\Rule\Rule;
use Exception;

class Basket
{
    /** @var Product[] */
    private $products;

    /** @var Rule[] */
    private $rules;

    /** @var Offer[] */
    private $offers;

    /** @var Product[] */
    private $items = [];

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
        $this->products[$product->getCode()] = $product;
        return $this;
    }

    public function getProductByCode(string $code): ?Product
    {
        return $this->products[$code] ?? null;
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

    /**
     * @return Product[]
     */
    public function getItems(): array
    {
        return $this->items;
    }

    public function add(string $productCode): Basket
    {
        $product = $this->getProductByCode($productCode);

        if (null === $product) {
            throw new Exception(sprintf('Product with code %s not in product catalogue.', $productCode));
        }

        $this->items[] = $product;

        return $this;
    }

    public function total(): float
    {
        $items = $this->getItems();
        $total = 0;

        foreach ($this->getItems() as $item) {
            $total += $item->getPrice();
        }

        foreach ($this->getOffers() as $offer) {
            $total -= $offer->getDiscount($items);
        }

        $deliveryCost = 0;

        foreach ($this->getRules() as $rule) {
            $cost = $rule->getDeliveryCost($total);

            if ($cost && ($cost > $deliveryCost)) {
                $deliveryCost = $cost;
            }
        }

        return floor(($total + $deliveryCost) * 100) / 100;
    }
}

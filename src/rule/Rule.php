<?php

namespace Acme\Rule;

interface Rule
{
    public function getDeliveryCost(string $total): ?float;
}

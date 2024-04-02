<?php

namespace App\Class\Discount;

interface DiscountInterface
{
   public function calculate($payDate, int $price):int|float;
}
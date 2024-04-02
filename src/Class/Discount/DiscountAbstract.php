<?php

namespace App\Class\Discount;
use DateTimeImmutable;

abstract class DiscountAbstract implements DiscountInterface
{
    protected $discounts = [
        '08' => 0.07,
        '09' => 0.05,
        '10' => 0.03
    ];

    protected $nowDate;
    private int|float $price;
    public function __construct()
    {
        $this->nowDate = new DateTimeImmutable();
    }
    public function calculate($payDate, int $price): int|float
    {
        if ($payDate > $this->nowDate && in_array($payDate->format('m') , array_keys($this->discounts)))
            return round($price * $this->discounts[$payDate->format('m')]);
        else
            return 0;
    }

    public static function forTest($discount, $payDate, int $price = 10000): float|int
    {
        $price = (string) $discount->calculate($payDate, $price);
        echo $price. "\n";
        return $price;
    }
}
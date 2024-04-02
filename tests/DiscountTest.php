<?php

namespace App\Tests;

use App\Class\Discount\Discount;
use App\Class\Discount\DiscountAbstract;
use App\Class\Discount\DiscountOne;
use App\Class\Discount\DiscountTwo;
use App\Class\Discount\DiscoutThree;
use PHPUnit\Framework\TestCase;
use DateTimeImmutable;

class DiscountTest extends TestCase
{
    public function testSomething(): void
    {
        //тестируем скидку Discount One

        $this->DiscountTest(new DiscountOne(), new DateTimeImmutable(),'0');
        $this->DiscountTest(new DiscountOne(), new DateTimeImmutable('01-08-2024'),'700');
        $this->DiscountTest(new DiscountOne(), new DateTimeImmutable('01-09-2024'),'500');
        $this->DiscountTest(new DiscountOne(), new DateTimeImmutable('01-10-2024'),'300');
        $this->DiscountTest(new DiscountOne(), new DateTimeImmutable('01-11-2024'),'0');

        $this->DiscountTest(new DiscountTwo(), new DateTimeImmutable(),'0');
        $this->DiscountTest(new DiscountTwo(), new DateTimeImmutable('15-11-2024'),'700');
        $this->DiscountTest(new DiscountTwo(), new DateTimeImmutable('15-12-2024'),'500');
        $this->DiscountTest(new DiscountTwo(), new DateTimeImmutable('15-01-2025'),'300');
        $this->DiscountTest(new DiscountTwo(), new DateTimeImmutable('15-02-2025'),'0');

        $this->DiscountTest(new DiscoutThree(), new DateTimeImmutable('15-03-2024'),'0');
        $this->DiscountTest(new DiscoutThree(), new DateTimeImmutable(),'500');
        $this->DiscountTest(new DiscoutThree(), new DateTimeImmutable('15-05-2025'),'300');
        $this->DiscountTest(new DiscoutThree(), new DateTimeImmutable('15-06-2025'),'0');


        $price = (string) Discount::calculate(
            new DateTimeImmutable('15-05-2025'),
            new DateTimeImmutable(),
            10000,
            new DateTimeImmutable('17-10-1987')
        );

        echo "\nТестируем функцию  Discoun calculate ".$price." \n";
        $this->assertSame("10000",$price);



    }
    private function DiscountTest(DiscountAbstract $discount, $date, $waiting = '' , $price = '10000'){

        echo "\nТестируем функцию ".get_class($discount)." для даты ".$date->format("d.m.Y")." \n";
        $price = (string) $discount::forTest($discount, $date, 10000);
        $this->assertSame($waiting,$price);

    }




}

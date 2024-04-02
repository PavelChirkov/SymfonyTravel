<?php

namespace App\Tests;

use App\Class\Age\AgeClass;
use App\Class\Age\AgeDiscount;
use PHPUnit\Framework\TestCase;
use DateTimeImmutable;

class AgeTest extends TestCase
{
    public function testSomething(): void
    {
        echo "Тестируем Age Class \n";
        $dataBirth = new DateTimeImmutable('17-10-1987');
        $now =  new DateTimeImmutable();
        $year = (string) AgeClass::enter($dataBirth, $now);
        echo "Возраст: ".$year." \n";
        $this->assertSame("36",$year);

        $this->ageDiscountTest(new DateTimeImmutable('17-10-1987'),"10000");
        $this->ageDiscountTest(new DateTimeImmutable('17-10-2020'),"2000");
        $this->ageDiscountTest(new DateTimeImmutable('17-10-2016'),"5500");
        $this->ageDiscountTest(new DateTimeImmutable('17-10-2011'),"9000");



    }

    private function ageDiscountTest($date, $waiting = "" ){
        $discount = AgeDiscount::ageDisountTest($date);
        $this->assertSame($waiting,$discount);
    }
}

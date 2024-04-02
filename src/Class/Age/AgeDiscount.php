<?php

namespace App\Class\Age;
use DateTimeImmutable;
class AgeDiscount
{
    public static function discount($birthDate, $travelStartDate,int |string $price) :float {
        $age = AgeClass::enter($birthDate, $travelStartDate);
        if ($age >= 3 && $age <= 5) return $price - ($price * 0.8);
        elseif ($age >= 6 && $age <= 11) {
            $discount = $price - ($price * 0.3);
            if($discount > 4500) return $price - 4500;
            else return $discount;
        }elseif ($age == 12) return $price - ($price * 0.1);
        return round($price);
    }
    public static function ageDisountTest($date, $price = 10000){
        echo "\n Тестируем Age Discount \n";
        echo "Для даты рождения:".$date->format("d.m.Y")." \n";
        $discount = (string) AgeDiscount::discount($date, new DateTimeImmutable(), $price);
        echo $discount." \n";
        return $discount;
    }
}
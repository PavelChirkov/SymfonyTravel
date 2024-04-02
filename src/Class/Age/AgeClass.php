<?php

namespace App\Class\Age;

class AgeClass
{
    public static function enter($birthDate, $travelStartDate):int|float
    {
        $age = ($travelStartDate->format('Y') - $birthDate->format('Y'))  *  12 + $travelStartDate->format('m') - $birthDate->format('m');
        return floor($age/12);
    }
}
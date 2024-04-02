<?php

namespace App\Class\Discount;

use App\Class\Age\AgeDiscount;

class Discount
{
    public static function calculate($travelStartDate, $payDate, $price, $dataBirth)
    {
        $price = AgeDiscount::discount($dataBirth,$travelStartDate,$price);


        //расчет скидки для c октября текущего года по 15 января следующего
        if (($travelStartDate->format('m') >= 10 && date('Y') == $travelStartDate->format('Y') && $travelStartDate->format('d') >= 1) || ($travelStartDate->format('m') == 1 && date('Y') + 1 == $travelStartDate->format('Y') && $travelStartDate->format('d') < 15)) {
            $discount = new DiscoutThree();
            $price = $price - $discount->calculate($payDate, $price);
            return $price;
        }

        //расчет скидки для c 15 января следующего по апрель следующего
        if (($travelStartDate->format('m') >= 1 && $travelStartDate->format('m') <= 3 && $travelStartDate->format('d') >= 15) && date('Y') + 1 == $travelStartDate->format('Y')) {
            $discount = new DiscountOne();
            $price = $price - $discount->calculate($payDate, $price);
            return $price;
        }

        //расчет скидки для c апреля следующего по сентябрь следующего
        if (($travelStartDate->format('m') >= 4 && $travelStartDate->format('m') <= 9) && date('Y') < $travelStartDate->format('Y')) {
            $discount = new DiscountTwo();
            $price = $price - $discount->calculate($payDate, $price);
            return $price;
        }

        return $price;
    }
}
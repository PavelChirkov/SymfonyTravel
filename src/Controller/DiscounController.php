<?php

namespace App\Controller;

use App\Class\Age\AgeClass;
use App\Class\Age\AgeDiscount;
use App\Class\Discount\Discount;
use App\Class\PreviousBooking;
use DateTimeImmutable;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class DiscounController extends AbstractController
{
    #[Route('/discount', name: 'app_discoun')]
    public function index(Request $request): JsonResponse
    {


        $start = new DateTimeImmutable($request->get('date_start'));
        $pay = new DateTimeImmutable($request->get('pay'));

        $pb = Discount::calculate(
            $start,
            $pay,
            (int)$request->get('price'),
            new DateTimeImmutable($request->get('data_birth'))
        );

        return $this->json([
            'Начало тура' => $start->format('Y-m-d'),
            'Оплата' => $pay->format('Y-m-d'),
            'Возраст' => AgeClass::enter(new DateTimeImmutable($request->get('data_birth')), new DateTimeImmutable($request->get('date_start'))),
            'Ранее бронирование' => $pb
        ]);

    }
}

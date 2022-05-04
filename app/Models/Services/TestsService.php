<?php


namespace App\Models\Services;


use Tests\Feature\LoginPage\LoginPageTest;
use Tests\Unit\ClientRequest\ClientRequestTest;
use Tests\Unit\Leads\Train\AutomationOrdersCreatingTest;
use Tests\Unit\Orders\TrainOrderTest;

class TestsService
{
    public function getAllTests():array
    {
        return [
            [
                'title' => 'Клиентская Заявка',
                'class' => ClientRequestTest::class
            ],
            [
                'title' => 'ЖД Заявки',
                'class' => TrainOrderTest::class
            ],
            [
                'title' => 'Страница Логина',
                'class' => LoginPageTest::class
            ],
            [
                'title' => 'Автоматизация создания ЖД заявок',
                'class' => AutomationOrdersCreatingTest::class
            ]
        ];
    }
}

<?php


namespace App;


class Title
{
    public static function get()
    {
        return [
            'orderResponsibleBranchChief' => 'Не является обязательным. Выбирается по необходимости',
            'orderActiveResponsible' => 'Сотрудник, работающий с Заявкой в текущем времени. Его Задача - выполнить положенную по Заявке работу и перевести её на следующий Этап',
            'leadIndex' => [
                'lead' => 'Карточка Сделки - самая глобальная и важная. Это Документ, регулирующий процесс работы с Клиентом от подачи им Клиентской Заявки , описание и Согласования работы через Заявки в Отделы, Календарный План - отображение проведения работы и Успешного Завершения.'
            ],
            'lead' => [
                'responsibleManager' => 'Сотрудник , создающий Сделку и несущий ответственность за её успешную реализацию. Менеджером Сделки может быть практически любой Пользователь, не считая Сотрудников Склада.

Ведёт диалог непосредственно с Клиентом. Также организовывает работу с помощью Заявок в Отделы для которых назначает Ответственных и учавствует в решении частных вопросов.

начиная от v 1.5.3.0 - принимает участие в Согласованиях и Корректировках Заявки в Отдел.
',
                'calendar' => 'Календарный План - это ""Карта"" Проекта , в котором отображены Заявки в Отделы, Этапы ,  Отчёты по Заявкам, Файлы и Фото, Даты и Статусы в Ячейках - ориентируясь на которые можно понимать картинку Сделки в целом.

Календарный План представляется в разрезе Дней и Этапов , с Задачей в Ячейке.

Статус Ячейки:
<b class="text-red">Красный</b> - ожидает Согласования Заявки в Отдел;
<b class="text-yellow">Жёлтый</b> - В Работе , ожидает выполнения и добавления Отчёта;
<b class="text-green">Зелёный</b> - Отчёт добавлен.

Статус Ячейки ""Создать Заявку"":
<b class="text-red">Красный</b> - ожидает Создания Заявки;
<b class="text-yellow">Жёлтый</b> - Заявка создана, заполняется, согласовывается;
<b class="text-green">Зелёный</b>  - Заявка в Отдел Согласована и запущена в работу (Заявка имеет Жёлтый Статус).'
            ],
            'ordersIndex' => [
                'clientRequest' => 'Базовая Заявка на основе которой строится вся работа. В КЗ описана суть задачи Клиента. Для реализации этой задачи - Создаются, Согласовываются и Реализовываются Заявки в Отделы.

в v 1.6.0.0 реализована Автоматизация Клиентской Заявки, где исходя из Заполненных Полей - создаются и наполняются нужные Заявки в Отделы и Поля.
   ',
                'orderForm' => 'Документ - регламентирубщий работу Отдела в рамках Сделки.
Постановщик - Менеджер Сделки. Основной Исполнитель - Сотрудник Отдела. В непростых ситуациях для решения вопросов - приходит на помощь Руководитель Отдела.

в v 1.5.0.0 Заявка в Отдел имеет Автоматизированые Статусы, меняющиеся в процессе Согласования и Коррестировок. Также меняется Активно Ответсвенный.'
            ],
            'clientRequest' => [
                'statuses' => '<b class="text-red">Красный</b> - нужно создать.
<b class="text-yellow">Жёлтый</b> - создали и редактируется.
<b class="text-green">Зелёный</b>  - Согласована Менеджером Сделки и Клиентом , Автоматически создаются Заявки в Отделы.',
                'notes' => 'Примечания - позволяют вести и сохранять в Ленте диалог между Клиентом и Менеджером Сделки.'
            ],
            'orderForm' => [
                'responsibleUser' => 'Основной Исполнитель, отвечает за успешное выполнение Заявки в Отдел.
Его инструменты - Знания Умения Навыки , позволяющие спланировать работу, Согласовать Заявку в Отдел, выполнить её с надлежащим качеством, и грамотно и в срок отчитаться о Результате (прикрепить Отчёт по Заявке за каждый надлежащий День в Календарном Плане в Ячейках) , и получить признание и успех за добросовестно выполненую работу.

Может быть Пользователь из Сотрудников и Руководителей Отдела.

начиная от v 1.5.3.0 - принимает участие в Согласованиях и Корректировках Заявки в Отдел - это Автоматизация Статусов и Активно Ответственного .',
                'responsibleChief' => 'Является поддержкой для Сотрудника Отдела и гарантом успешной реализации Заявки в Отдел с Целью профессиональной работы по Сделке и предоставлению Клиентского Сервиса. В случае возникновения непростых вопросов подключается и решает их внутри Отдела или с Менеджером Сделки.

начиная от v 1.5.3.0 - принимает участие в Согласованиях и Корректировках Заявки в Отдел.',
                'notes' => 'Интерактивные Примечания - позволяют путём Согласования и Корректировок и комментариям к ним вести работу по Заявке в Отдел

текущий Активно Ответственный - отмечать Согласовано / Корректировки , далее по логике меняется Активно Ответственный и Статус Заявки в Отдел.
',
                'activeResponsibleUser' => 'Менеджер Сделки или Руководитель Отдела или Сотрудник Отдела , который работает с Заявкой в текущий момент. Перевод Активно Ответственного происходит путём Согласования и Корректировок.'
            ],
            'firstOrderForm' => [
                'orderFormStatuses' => '<b class="text-red">Красный</b> - создали , заполняется , назначаются Ответственные Руководитель и Сотрудник. Согласовается; Редактировать Заявку может только Менеджер Сделки только при Красном Статусе , и если является Активно Ответственныт.
<b class="text-yellow">Жёлтый</b> - Сотрудник Отдела ""принял Заявку в работу"", прикрепляет Отчёты по Заявкам в Жёлтые Ячейки .
<b class="text-green">Зелёная</b>  - Заявка выполнена, вопросов ни у кого нет. Статус Возможен Зелёный для Заявки, если все Ячейки у Заявки Зелёные.

в v 1.5.3.0 - реализована Автоматизаия Статусов исходя из Процесса Согалсований и Корректировок.',
                'leadsStatuses' => 'Статусы для Сделки меняется вручную Менеджером Сделки.

<b class="text-red">Красный</b> - есть хотябы одна Красная Заявка в Отдел;
<b class="text-yellow">Жёлтый</b> - если нет Красных Заявок в Отделы, и есть Жёлтые;
<b class="text-green">Зелёный</b>  - если все Заявки в Отделы Зелёные.'
            ]
        ];
    }
}
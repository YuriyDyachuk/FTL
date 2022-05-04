<div class="regulation_form">
    <div class="kt-checkbox-list">

        <label class="kt-checkbox">
            Подача контейнера под загрузку на склад указанный в заявке Клиента
            <input {{ $client['regulation_1'] ? 'checked' : '' }} type="checkbox" name="client[regulation_1]"><span></span>
        </label>

        <label class="kt-checkbox">
            Перевозка груза со склада хранения на склад Экспедитора
            <input {{ $client['regulation_2'] ? 'checked' : '' }} type="checkbox" name="client[regulation_2]"><span></span>
        </label>

        <label class="kt-checkbox">
            Перевозка железнодорожным транспортом
            <input {{ $client['regulation_3'] ? 'checked' : '' }} type="checkbox" name="client[regulation_3]"><span></span>
        </label>

        <label class="kt-checkbox">
            Перевозка морским транспортом
            <input {{ $client['regulation_4'] ? 'checked' : '' }} type="checkbox" name="client[regulation_4]"><span></span>
        </label>

        <label class="kt-checkbox">
            Консолидация груза на складе Экспедитора
            <input {{ $client['regulation_5'] ? 'checked' : '' }} type="checkbox" name="client[regulation_5]"><span></span>
        </label>

        <label class="kt-checkbox">
            Приём груза на складе экспедитора с пересчётом мест
            <input {{ $client['regulation_6'] ? 'checked' : '' }} type="checkbox" name="client[regulation_6]"><span></span>
        </label>

        <label class="kt-checkbox">
            Фото-фиксация принятого на склад Экспедитора груза
            <input {{ $client['regulation_7'] ? 'checked' : '' }} type="checkbox" name="client[regulation_7]"><span></span>
        </label>

        <label class="kt-checkbox">
            Предоставление Клиенту отчёта о принятом на склад Экспедитора грузе
            <input {{ $client['regulation_8'] ? 'checked' : '' }} type="checkbox" name="client[regulation_8]"><span></span>
        </label>

        <label class="kt-checkbox">
            Хранение груза на складе экспедитора (не для алкогольной и спиртосодержащей продукции)
            <input {{ $client['regulation_9'] ? 'checked' : '' }} type="checkbox" name="client[regulation_9]"><span></span>
        </label>

        <label class="kt-checkbox">
            Загрузка в контейнер с применением расходных материалов на основании заявки клиента
            <input {{ $client['regulation_10'] ? 'checked' : '' }} type="checkbox" name="client[regulation_10]"><span></span>
        </label>

        <label class="kt-checkbox">
            Подача заявки 3-им лицам на предоставление крупнотоннажного контейнера
            <input {{ $client['regulation_11'] ? 'checked' : '' }} type="checkbox" name="client[regulation_11]"><span></span>
        </label>

        <label class="kt-checkbox">
            Подача заявки 3-им лицам на предоставление вагона (платформы)
            <input {{ $client['regulation_12'] ? 'checked' : '' }} type="checkbox" name="client[regulation_12]"><span></span>
        </label>

        <label class="kt-checkbox">
            Подача заявки 3-им лицам на предоставление контейнера-места в поезде
            <input {{ $client['regulation_13'] ? 'checked' : '' }} type="checkbox" name="client[regulation_13]"><span></span>
        </label>

        <label class="kt-checkbox">
            Взаимодействие с государственными службами по заявке Клиента и от его имени по доверенности: Ветеринарная инспекция, Фитосанитарный контроль, РЖД, Транспортная прокуратура, портовыми и причальными службами
            <input {{ $client['regulation_14'] ? 'checked' : '' }} type="checkbox" name="client[regulation_14]"><span></span>
        </label>

        <label class="kt-checkbox">
            Заказ авто для вывоза контейнера до склада Клиента
            <input {{ $client['regulation_15'] ? 'checked' : '' }} type="checkbox" name="client[regulation_15]"><span></span>
        </label>

        <label class="kt-checkbox">
            Перегрузка груза в другую(-ие) транспортное(-ые) средства
            <input {{ $client['regulation_16'] ? 'checked' : '' }} type="checkbox" name="client[regulation_16]"><span></span>
        </label>

        <label class="kt-checkbox">
            Выставление контейнеров на площадку под загрузку
            <input {{ $client['regulation_17'] ? 'checked' : '' }} type="checkbox" name="client[regulation_17]"><span></span>
        </label>

        <label class="kt-checkbox">
            Крановые работы для перемещения груза на погрузочной площадке Экспедитора
            <input {{ $client['regulation_18'] ? 'checked' : '' }} type="checkbox" name="client[regulation_18]"><span></span>
        </label>

        <label class="kt-checkbox">
            Пересчёт мест в пункте назначения
            <input {{ $client['regulation_19'] ? 'checked' : '' }} type="checkbox" name="client[regulation_19]"><span></span>
        </label>

        <label class="kt-checkbox">
            Стикировка мест
            <input {{ $client['regulation_20'] ? 'checked' : '' }} type="checkbox" name="client[regulation_20]"><span></span>
        </label>

        <label class="kt-checkbox">
            Отслеживание транспортного средства на всём протяжении пути
            <input {{ $client['regulation_21'] ? 'checked' : '' }} type="checkbox" name="client[regulation_21]"><span></span>
        </label>

        <label class="kt-checkbox">
            Предоставить представителю клиента рабочее место
            <input {{ $client['regulation_22'] ? 'checked' : '' }} type="checkbox" name="client[regulation_22]"><span></span>
        </label>

        <label class="kt-checkbox">
            Обеспечить подборку груза на складе Экспедитора по параметрам клиента
            <input {{ $client['regulation_23'] ? 'checked' : '' }} type="checkbox" name="client[regulation_23]"><span></span>
        </label>

        <label class="kt-checkbox">
            Замер груза (взвешивание, измерение объёма)
            <input {{ $client['regulation_24'] ? 'checked' : '' }} type="checkbox" name="client[regulation_24]"><span></span>
        </label>

    </div>

</div>

@if(isset($edit) && $edit === false)
    @section('js')
        <script>
            $(() => {
                $('.regulation_form input').attr('disabled', true);
            });
        </script>
    @stop
@endif

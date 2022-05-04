<h3>Груз</h3>
<div class="order-product-wrapper mt-5">
    @if($client->products()->exists())
        @foreach($client->products as $n => $product)
            <div style="position: relative;" class="product-form-wrapper">
                <div class="row">
                    <div class="col-md-10">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label">Название</label>
                                    <div class="col-lg-8">
                                        <input disabled value="{{ $product['cargo'] }}" class="form-control" type="text">
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group row ">
                                    <label class="col-lg-6 col-form-label pl-0">Масса, кг</label>
                                    <div class="col-lg-6" style="margin-left: -15px;">
                                        <input disabled value="{{ $product['weight'] }}" class="form-control" type="text">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group row">
                                    <label class="col-lg-6 col-form-label pl-0">Объём, м3</label>
                                    <div class="col-lg-6">
                                        <input disabled value="{{ $product['volume'] }}" class="form-control" type="text">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="product-dt-wrapper">
                                    <div style="position: relative;" class="dt-form-wrapper" >
                                        <div class="row">
                                            <div class="col-md-5">
                                                <div class="form-group row">
                                                    <label class="col-lg-5 col-form-label">Тип Загрузки</label>
                                                    <div class="col-lg-7" style="padding-left: 10px;">
                                                        <select disabled class="form-control download_type_select">
                                                            <option @php echo $product['download_type'] == 'pallet' ? 'selected' : '' @endphp value="pallet">Паллет</option>
                                                            <option @php echo $product['download_type'] == 'naval' ? 'selected' : '' @endphp value="naval">Навал</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-7">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group row">
                                                            <label class="col-lg-4 col-form-label p-0">Размер Паллет</label>
                                                            <div class="col-lg-8 p-0">
                                                                <select disabled class="form-control">
                                                                    <option value=""></option>
                                                                    <option @php echo $product['pallet_size'] == '1200*80*1600' ? 'selected' : '' @endphp value="1200*80*1600">1200*80*1600</option>
                                                                    <option @php echo $product['pallet_size'] == '1200*80*1800' ? 'selected' : '' @endphp value="1200*80*1800">1200*80*1800</option>
                                                                    <option @php echo $product['pallet_size'] == '1200*80*20' ? 'selected' : '' @endphp value="1200*80*20">1200*80*20</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group row">
                                                            <label class="col-lg-8 col-form-label pr-0" style="margin-right: -4px;">Кол-во</label>
                                                            <div class="col-lg-4" style="padding-left: 0; padding-right: 9px;">
                                                                <input disabled value="{{ $product['amount'] }}" type="text" class="form-control">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    @else
        <div style="position: relative;" class="product-form-wrapper">
            <div class="row">
                <div class="col-md-10">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-lg-4 col-form-label">Название</label>
                                <div class="col-lg-8">
                                    <input disabled class="form-control" type="text">
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group row ">
                                <label class="col-lg-6 col-form-label pl-0">Масса, кг</label>
                                <div class="col-lg-6">
                                    <input disabled class="form-control" type="text">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group row">
                                <label class="col-lg-6 col-form-label pl-0">Объём, м3</label>
                                <div class="col-lg-6">
                                    <input disabled class="form-control" type="text">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="product-dt-wrapper">
                        <div style="position: relative;" class="dt-form-wrapper">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group row">
                                        <label class="col-lg-4 col-form-label">Тип Загрузки</label>
                                        <div class="col-lg-8">
                                            <select disabled class="form-control download_type_select">
                                                <option selected value="pallet">Паллет</option>
                                                <option value="naval">Навал</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-8 pallet-data">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label class="col-lg-4 col-form-label">Размер Паллет</label>
                                                <div class="col-lg-8">
                                                    <select disabled class="form-control">
                                                        <option value=""></option>
                                                        <option value="1200*80*1600">1200*80*1600</option>
                                                        <option value="1200*80*1800">1200*80*1800</option>
                                                        <option value="1200*80*20">1200*80*20</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label class="col-lg-4 col-form-label">Кол-во Паллет</label>
                                                <div class="col-lg-8">
                                                    <input disabled type="text" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-8 naval-data d-none">
                                    <div class="col-md-12">
                                        <div class="form-group row">
                                            <label class="col-lg-4 col-form-label">Кол-во мест</label>
                                            <div class="col-lg-8">
                                                <input disabled type="text" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    @endif


</div>

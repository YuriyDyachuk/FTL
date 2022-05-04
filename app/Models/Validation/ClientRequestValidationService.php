<?php

namespace App\Models\Validation;

use Validator;

class ClientRequestValidationService extends ValidationService implements IValidation
{
    private $ftlwhFromValidation;
    private $goodsValidation;

    public function __construct(FtlwhFromValidation $ftlwhFromValidation, GoodsValidation $goodsValidation)
    {
        $this->ftlwhFromValidation = $ftlwhFromValidation;
        $this->goodsValidation = $goodsValidation;
    }

    public function validate(array $request)
    {
        $this->setRulesWithMessage('product.*.name', 'required',
            'product.*.name.required', 'Поле Название Груза обязательно к заполнению');

        $this->setRules('product.*.weight', 'required|numeric|min:1');
        $this->setMessages('product.*.weight.required', 'Поле Масса Груза обязательно к заполнению.');
        $this->setMessages('product.*.weight.numeric', 'Поле Масса Груза должно быть числом.');
        $this->setMessages('product.*.weight.min', 'Поле Масса Груза должно быть не менее 1.');

        $this->setRules('product.*.amount', 'required|numeric|min:1');
        $this->setMessages('product.*.amount.required', 'Поле Кол-во Груза обязательно к заполнению.');
        $this->setMessages('product.*.amount.numeric', 'Поле Кол-во Груза должно быть числом.');
        $this->setMessages('product.*.amount.min', 'Поле Кол-во Груза должно быть не менее 1.');

        $this->setRules('product.*.volume', 'required|numeric|min:1');
        $this->setMessages('product.*.volume.required', 'Поле Объём Груза обязательно к заполнению.');
        $this->setMessages('product.*.volume.numeric', 'Поле Объём Груза должно быть числом.');
        $this->setMessages('product.*.volume.min', 'Поле Объём Груза должно быть не менее 1.');

        $validator = Validator::make($request, $this->rules, $this->messages);
        $messageBag = $validator->getMessageBag();
        $messageBag->merge($this->ftlwhFromValidation->validate($request['ftlwhFrom']))
            ->merge($this->goodsValidation->validate($request));

        return $messageBag;
    }
}

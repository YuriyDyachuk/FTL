<?php


namespace App\Models\Validation;


class OrderValidation extends ValidationService implements IValidation
{

    private $goodsValidation;

    public function __construct(GoodsValidation $goodsValidation)
    {
        $this->goodsValidation = $goodsValidation;
    }

    public function validate(array $request, $isSingle = false)
    {
//        $this->setRulesWithMessage('responsible_user_id', 'required',
//            'responsible_user_id.required', 'Поле ответственный сотрудник обязательны для заполнения.');

//        $this->setRulesWithMessage('responsible_chief_id', 'required',
//            'responsible_chief_id.required', 'Поле ответственный руководитель обязательны для заполнения.');



        $validator = \Validator::make($request, $this->rules, $this->messages);

        $messageBag = $validator->getMessageBag();
        if($isSingle === true){
            $messageBag->merge($this->goodsValidation->validate($request));
        }
        return $messageBag;
    }
}

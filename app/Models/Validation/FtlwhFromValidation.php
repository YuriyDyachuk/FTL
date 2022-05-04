<?php


namespace App\Models\Validation;


use App\Rules\KtkOwner;
use App\Rules\KtkPrefix;

class FtlwhFromValidation extends ValidationService implements IValidation
{
    public function validate(array $request)
    {
        $this->setRules('unl_cont_ktk_prefix', new KtkPrefix());
        $this->setRulesWithMessage('tm_code', 'nullable|integer',
            'tm_code.integer', 'Поле Код терминала на терминале должно быть целым числом.');
        $this->setRulesWithMessage('pickup_code', 'nullable|integer',
            'pickup_code.integer', 'Поле Код должно быть целым числом.');
        $this->setRulesWithMessage('unl_tr_code', 'nullable|integer',
            'unl_tr_code.integer', 'Поле Код должно быть целым числом.');
        $this->setRules('unl_tr_railway_carriage_owner_inn', new KtkOwner('Поле Собственник вагона ИНН должно составлять 10 или 12 символов.'));
        $this->setRules('unl_cont_ktk_owner_inn', new KtkOwner('Поле Собственник КТК ИНН должно составлять 10 или 12 символов.'));
        foreach (['tm_power_of_attorney_scan_file', 'pickup_power_of_attorney_scan_file'] as $item){
            $this->setRulesWithMessage($item, 'nullable|mimes:jpeg,jpg,bmp,png,pdf',
                "$item.mimes", 'Поле Доверенность Скан, допустимые форматы файлов: jpeg,jpg,bmp,png,pdf');
        }
        foreach (['tm_power_of_attorney_number', 'pickup_power_of_attorney_number'] as $item) {
            $this->setRulesWithMessage($item, 'nullable|integer',
                "$item.integer", 'Поле Доверенность № должно быть целым числом.');
        }
        $this->setRules('unl_cont_ktk_number', 'nullable|integer|digits:7');
        $this->setMessages('unl_cont_ktk_number.integer', 'Поле КТК номер должно быть целым числом.');
        $this->setMessages('unl_cont_ktk_number.digits', 'Поле КТК номер должно составлять 7 символов.');
        $validator = \Validator::make($request, $this->rules, $this->messages);
        return $validator;
    }
}

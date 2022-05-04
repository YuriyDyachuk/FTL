<?php

namespace App\Models\Entities;


use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $client_request_id
 * @property int $type
 * @property string $city
 * @property string $address_address
 * @property string $tr_name
 * @property string $tr_code
 * @property string $tr_address
 * @property string $tr_railway_carriage_owner_name
 * @property string $tr_railway_carriage_owner_inn
 * @property string $unl_date
 * @property boolean $unl_time_is_interval
 * @property string $unl_time_from
 * @property string $unl_time_to
 * @property string $unl_time
 * @property string $unl_on
 * @property string $unl_cont_ktk_type
 * @property string $unl_cont_ktk_prefix
 * @property string $unl_cont_ktk_number
 * @property string $unl_cont_ktk_owner_name
 * @property string $unl_cont_ktk_owner_inn
 * @property boolean $client_has_container
 * @property string $client_container_place
 * @property string $tm_name
 * @property string $tm_code
 * @property string $tm_city
 * @property string $tm_address
 * @property string $tm_power_of_attorney_number
 * @property string $tm_power_of_attorney_scan
 * @property string $pickup_name
 * @property string $pickup_code
 * @property string $pickup_city
 * @property string $pickup_address
 * @property string $pickup_power_of_attorney_number
 * @property string $pickup_power_of_attorney_scan
 * @property string $unl_tr_name
 * @property string $unl_tr_code
 * @property string $unl_tr_address
 * @property string $unl_tr_railway_carriage_owner_name
 * @property string $unl_tr_railway_carriage_owner_inn
 * @property string $created_at
 * @property string $updated_at
 * @property ClientRequests $clientRequest
 * @property string $ftl_wh
 * @property string $contact_name
 * @property string $contact_phone
 * @property string $driving_scheme
 */
class ClientRequestFrom extends Model
{
    const ADDRESS_TYPE = 1;
    const FTL_WH_TYPE = 2;
    const TRAIN_ST_TYPE = 3;

    const UNL_ON_CONTAINER = 1;
    const UNL_ON_RAIL_CARR = 2;
    const UNL_ON_TR_STATION = 3;
    const UNL_ON_CAR = 4;

    const CONT_PLACE_TM = 1;
    const CONT_PLACE_PICKUP = 2;

    public static function getContainerPlaces()
    {
        return [
            self::CONT_PLACE_TM => 'На Терминале',
            self::CONT_PLACE_PICKUP => 'Привезёт Клиент'
        ];
    }

    public static function getTypeNames()
    {
        return [
            self::ADDRESS_TYPE => 'Склад',
            self::FTL_WH_TYPE => 'Склад ФТЛ',
            self::TRAIN_ST_TYPE => 'ЖД Станция',
        ];
    }

    public static function getFtlWh()
    {
        return [
          //  'МО' => 'МО адрес',
            'РФ, г. Подольск, ул. Вишнёвая 11' => 'РФ, г. Подольск, ул. Вишнёвая 11',
            'РФ , г. Владивосток , ул. Светлая, 7' => 'РФ , г. Владивосток , ул. Светлая, 7'
        ];
    }

    public static function unloadingTypesList(int $leadType)
    {
        $types = [
            self::UNL_ON_CONTAINER => 'Контейнер',
            self::UNL_ON_RAIL_CARR => 'Вагон',
        ];

        if($leadType === Leads::CAR_TYPE){
            $types = [
                self::UNL_ON_CAR => 'Машина'
            ];
        }

        return $types;
    }

    public static function getUnloadingTypes()
    {
        return [
            self::UNL_ON_CONTAINER => 'Контейнер',
            self::UNL_ON_RAIL_CARR => 'Вагон',
       //     self::UNL_ON_TR_STATION => 'ЖД станция',
            self::UNL_ON_CAR => 'Машина'
        ];
    }

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'client_request_from';

    /**
     * The "type" of the auto-incrementing ID.
     *
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['driving_scheme', 'contact_name', 'contact_phone', 'ftl_wh', 'city', 'client_request_id', 'type', 'address_address', 'tr_name', 'tr_code', 'tr_address', 'tr_railway_carriage_owner_name', 'tr_railway_carriage_owner_inn', 'unl_date', 'unl_time_is_interval', 'unl_time_from', 'unl_time_to', 'unl_time', 'unl_on', 'unl_cont_ktk_type', 'unl_cont_ktk_prefix', 'unl_cont_ktk_number', 'unl_cont_ktk_owner_name', 'unl_cont_ktk_owner_inn', 'client_has_container', 'client_container_place', 'tm_name', 'tm_code', 'tm_city', 'tm_address', 'tm_power_of_attorney_number', 'tm_power_of_attorney_scan', 'pickup_name', 'pickup_code', 'pickup_city', 'pickup_address', 'pickup_power_of_attorney_number', 'pickup_power_of_attorney_scan', 'unl_tr_name', 'unl_tr_code', 'unl_tr_address', 'unl_tr_railway_carriage_owner_name', 'unl_tr_railway_carriage_owner_inn', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function clientRequest()
    {
        return $this->belongsTo(ClientRequests::class);
    }

    public function contacts()
    {
        return $this->hasMany(ClientRequestFromContacts::class, 'client_request_from_id', 'id');
    }

}

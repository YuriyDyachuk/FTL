<?php

namespace App\Models\Entities;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $getting_act_id
 * @property string $fio
 * @property string $phone
 * @property string $passport_data
 * @property string $number_and_date_of_vu_delivery
 * @property string $mark_and_number_of_car
 * @property string $trailer_num
 * @property string $created_at
 * @property string $updated_at
 * @property GettingAct $gettingAct
 */
class GettingActDriverReport extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'getting_act_driver_report';

    /**
     * The "type" of the auto-incrementing ID.
     *
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['getting_act_id', 'fio', 'phone', 'passport_data', 'number_and_date_of_vu_delivery', 'mark_and_number_of_car', 'trailer_num', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function gettingAct()
    {
        return $this->belongsTo(GettingAct::class);
    }
}

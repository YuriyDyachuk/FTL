<?php

namespace App\Models\Entities\Report;

use App\Models\Entities\Order;
use App\Models\Traits\OrderReport;
use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $order_id
 * @property string $warming
 * @property string $plastic_film
 * @property string $styrofoam
 * @property string $hardboard
 * @property string $osb
 * @property string $cardboard
 * @property string $streych_film
 * @property string $crate_photo
 * @property boolean $crate_enabled
 * @property boolean $evr_pallet_enabled
 * @property string $places_recalculation
 * @property string $internal_investments_recalculation
 * @property string $internal_investments_recalculation_photo
 * @property string $stickering_photo
 * @property boolean $stickering_enabled
 * @property string $seat_filling_photo
 * @property boolean $seat_filling_enabled
 * @property string $pallet_formation_photo
 * @property boolean $pallet_formation_enabled
 * @property string $parameters_formation_photo
 * @property boolean $parameters_formation_enabled
 * @property string $knitting_wire_fixation_photo
 * @property boolean $knitting_wire_fixation_enabled
 * @property string $sealing_van_photo
 * @property boolean $sealing_van_enabled
 * @property string $photofix_photo
 * @property boolean $photofix_enabled
 * @property string $created_at
 * @property string $updated_at
 * @property Order $order
 * @property string $styrofoam_count
 * @property string $hardboard_count
 * @property string $osb_count
 * @property string $cardboard_count
 * @property int $status
 */
class ForwardingReport extends Model
{
    use OrderReport;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'forwarding_report';

    /**
     * The "type" of the auto-incrementing ID.
     *
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['styrofoam_count', 'hardboard_count', 'osb_count', 'cardboard_count', 'order_id', 'warming', 'plastic_film', 'styrofoam', 'hardboard', 'osb', 'cardboard', 'streych_film', 'crate_photo', 'crate_enabled', 'evr_pallet_enabled', 'places_recalculation', 'internal_investments_recalculation', 'internal_investments_recalculation_photo', 'stickering_photo', 'stickering_enabled', 'seat_filling_photo', 'seat_filling_enabled', 'pallet_formation_photo', 'pallet_formation_enabled', 'parameters_formation_photo', 'parameters_formation_enabled', 'knitting_wire_fixation_photo', 'knitting_wire_fixation_enabled', 'sealing_van_photo', 'sealing_van_enabled', 'photofix_photo', 'photofix_enabled', 'created_at', 'updated_at', 'status'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}

<?php

namespace App\Models\Entities;



use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $note_type
 * @property mixed $text
 * @property string $created_at
 * @property string $updated_at
 * @property integer $order_id
 * @property integer $note_desc
 * @property Order $order
 */
class OrderNotes extends Model
{

    const SYSTEM_NOTE_TYPE = 1;
    const USER_NOTE_TYPE = 2;

    const COORDINATION_NOTE_DESC = 1;
    const ADJUSTMENTS_NOTE_DESC = 2;

    /**
     * The "type" of the auto-incrementing ID.
     *
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['note_type', 'text', 'order_id', 'note_desc', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

}

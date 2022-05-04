<?php

namespace App\Models\Entities\Block;

use App\Models\Entities\Block;

/**
 * @property integer $id
 * @property string $fio
 * @property string $phone
 * @property string $num
 * @property string $scan
 * @property int $block_type
 * @property int $block_id
 * @property string $created_at
 * @property string $updated_at
 */
class AgentBlock extends Block
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'agent_block';

    public function getBlockTitle():string
    {
        return 'Представитель';
    }

    public function getBlockType()
    {
        return Block::AGENT_TYPE;
    }

    public function blockTitle():string
    {
        return 'agent';
    }

    /**
     * The "type" of the auto-incrementing ID.
     *
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['fio', 'phone', 'num', 'scan', 'created_at', 'updated_at', 'block_type', 'block_id'];

}

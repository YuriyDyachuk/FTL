<?php


namespace App\Models\Repositories\Block;

use App\Models\Entities\Block\AgentBlock;
use App\Models\Entities\Block\DateTimeBlock;

class BlockRepository
{
    protected function createDateTime(int $block_id, int $block_type, ?array $data):void
    {
        DateTimeBlock::create(array_merge(['block_id' => $block_id, 'block_type' => $block_type], $data));
    }

    public function createAgent(int $block_id, int $block_type, ?array $data):void
    {
        AgentBlock::create(array_merge(['block_id' => $block_id, 'block_type' => $block_type], $data));
    }

}

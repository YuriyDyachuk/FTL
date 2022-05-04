<?php


namespace App\Models\Entities;

use App\Models\Entities\Block\{ClientBlock, FtlBlock, HeavyRentBlock, ProviderBlock, TerminalBlock, TrainBlock};
use Illuminate\Database\Eloquent\Model;

class Block extends Model
{
    const CLIENT_TYPE = 1;
    const FTL_TYPE = 2;
    const PROVIDER_TYPE = 3;
    const TERMINAL_TYPE = 4;
    const TRAIN_TYPE = 5;
    const ORDER_TYPE = 6;
    const HEAVY_RENT_TYPE = 7;
    const AGENT_TYPE = 8;
    const SPEC_CONDS_TYPE = 9;
    const DRIVER_TYPE = 10;
    const TRAIN_ORDER_TYPE = 11;
    const DATE_TIME_TYPE = 12;
    const PRODUCT_TYPE = 13;
    const DRIVER_REPORT_TYPE = 14;
    const SINGLE_ORDER_PRODUCTS = 15;

    public static function getBlockWidthByCount(int $count)
    {
        switch ($count){
            case 1:
                $width = 6;
                break;
            case 2:
                $width = 6;
                break;
            case 3:
                $width = 4;
                break;
            default:
                $width = 12 / $count;
                break;
        }
        return $width;
    }

    public function block()
    {
        switch($this->block_type){
            case self::CLIENT_TYPE:
                return $this->clientBlock;
                break;
            case self::FTL_TYPE:
                return $this->ftlBlock;
                break;
            case self::PROVIDER_TYPE:
                return $this->providerBlock;
                break;
            case self::TERMINAL_TYPE:
                return $this->terminalBlock;
                break;
            case self::TRAIN_TYPE:
                return $this->trainBlock;
                break;
            case self::ORDER_TYPE:
                return $this->order;
                break;
            case self::HEAVY_RENT_TYPE:
                return $this->heavyRentBlock;
            default:
                throw new \InvalidArgumentException('invalid block type');
        }
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function order()
    {
        return $this->hasOne(Order::class, 'id', 'block_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function clientBlock()
    {
        return $this->hasOne(ClientBlock::class, 'block_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function ftlBlock()
    {
        return $this->hasOne(FtlBlock::class, 'block_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function providerBlock()
    {
        return $this->hasOne(ProviderBlock::class, 'block_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function terminalBlock()
    {
        return $this->hasOne(TerminalBlock::class, 'block_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function trainBlock()
    {
        return $this->hasOne(TrainBlock::class, 'block_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function heavyRentBlock()
    {
        return $this->hasOne(HeavyRentBlock::class, 'block_id', 'id');
    }
}

<?php


namespace App\Models\Entities;


use App\Models\Entities\Block\DateTimeBlock;
use App\Models\Entities\Block\DriverBlock;
use App\Models\Entities\Block\SpecCondsBlock;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class OrderBlocksTemplate
{
    private ?array $points;
    private ?array $driver;
    private ?array $specialCondition;
    private ?DateTimeBlock $dateTime;

    public function __construct()
    {
        $this->points = $this->driver = $this->specialCondition = [];
        $this->dateTime = null;
    }

    /**
     * @return array|null
     */
    public function getPoints(): ?array
    {
        return $this->points;
    }

    /**
     * @param  int  $position
     * @param  Model|null|Collection  $point
     */
    public function addPoint(int $position, $point): void
    {
        $this->points[$position][] = $point;
    }

    /**
     * @return bool
     */
    public function pointsExists():bool
    {
        return !empty($this->points);
    }

    /**
     * @return array|null
     */
    public function getDriver(): ?array
    {
        return $this->driver;
    }

    /**
     * @param  DriverBlock|null|Collection  $driver
     */
    public function addDriver($driver): void
    {
        $this->driver[] = $driver;
    }

    /**
     * @return bool
     */
    public function driverExists():bool
    {
        return !empty($this->driver);
    }

    /**
     * @return array|null
     */
    public function getSpecialConditions(): ?array
    {
        return $this->specialCondition;
    }

    /**
     * @param  SpecCondsBlock|null|Collection  $specialCondition
     */
    public function addSpecialCondition($specialCondition): void
    {
        $this->specialCondition[] = $specialCondition;
    }

    /**
     * @return bool
     */
    public function specialConditionsExists():bool
    {
        return !empty($this->specialCondition);
    }

    /**
     * @return DateTimeBlock|null
     */
    public function getDateTime(): ?DateTimeBlock
    {
        return $this->dateTime;
    }

    /**
     * @param  DateTimeBlock|null  $dateTime
     */
    public function setDateTime(?DateTimeBlock $dateTime): void
    {
        $this->dateTime = $dateTime;
    }

    /**
     * @return bool
     */
    public function dateTimeExists():bool
    {
        return !empty($this->dateTime);
    }
}

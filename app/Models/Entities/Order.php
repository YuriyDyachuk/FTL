<?php


namespace App\Models\Entities;

use App\Models\Entities\Block\ClientBlock;
use App\Models\Entities\Block\DateTimeBlock;
use App\Models\Entities\Block\DriverBlock;
use App\Models\Entities\Block\FtlBlock;
use App\Models\Entities\Block\HeavyRentBlock;
use App\Models\Entities\Block\ProviderBlock;
use App\Models\Entities\Block\SpecCondsBlock;
use App\Models\Entities\Block\TerminalBlock;
use App\Models\Entities\Block\TrainBlock;
use App\Models\Entities\Block\TrainOrderBlock;
use App\Models\Entities\Pivot\GoodsOrders;
use App\Models\Entities\Report\CargoReport;
use App\Models\Entities\Report\CarPointReport;
use App\Models\Entities\Report\CarReport;
use App\Models\Entities\Report\DriverReport;
use App\Models\Entities\Report\ForwardingReport;
use App\Models\Entities\Report\HeavyRentReport;
use App\Models\Entities\Report\PowerOfAttorneyReport;
use App\Models\Entities\Report\RouteTrackReport;
use App\Models\Entities\Report\TrainReport;
use App\Models\Entities\Report\WaybillReport;
use App\Models\Entities\Report\WhGettingReport;
use App\Models\Services\OrderBlocksService;
use App\Models\Services\GoodsOrdersService;
use App\Models\Traits\OrderFormResponsibles;
use App\Models\Traits\OrderScopes;
use App\Models\UserManager;
use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Http\ResponseTrait;
use Illuminate\Support\Collection;
use Kyslik\ColumnSortable\Sortable;

/**
 * @property integer $id
 * @property integer $lead_id
 * @property int $type
 * @property int $name
 * @property string $index
 * @property int $status
 * @property integer $responsible_user_id
 * @property integer $active_responsible_user_id
 * @property integer $responsible_chief_id
 * @property integer $responsible_branch_chief_id
 * @property string $created_at
 * @property string $updated_at
 * @property Leads $lead
 * @property ClientBlock[] $clientBlocks
 * @property FtlBlock[] $ftlBlock
 * @property ProviderBlock[] $providerBlocks
 * @property TerminalBlock[] $terminalBlocks
 * @property TrainBlock[] $trainBlocks
 * @property DriverBlock[] $driverBlocks
 * @property SpecCondsBlock[] $specCondsBlocks
 * @property HeavyRentBlock[] $heavyRentBlocks
 * @property DateTimeBlock $dateTimeBlock
 * @property TrainOrderBlock[] $trainOrderFromBlocks
 * @property TrainOrderBlock[] $trainOrderToBlocks
 * @property TrainOrderBlock[] $trainOrderBlocks
 * @property string $notes
 * @property int $wh_gt_order_id
 * @property Order $whGtOrder
 * @mixin \Eloquent
 * @property int $is_single
 * @property Goods $goods
 * @property GoodsOrders $goodsOrders
 */
class Order extends Model
{
    use OrderFormResponsibles, OrderScopes, Sortable;

    const FTL_CITY = 'Подольск';
    const FTL_ADDRESS = 'ул. Вишнёвая, 11';

    const CAR_TYPE = 1;
    const TR_TYPE = 2;
    const WH_TYPE = 3;

    const CAR_HEAVY_RENT_NAME = 1;
    const CAR_PROVIDER_FTL_NAME = 2;
    const CAR_TM_FTL_TR_NAME = 3;
    const CAR_TM_PROVIDER_TR_NAME = 4;
    const CAR_TR_FTL_TM_NAME = 5;
    const CAR_TR_CLIENT_TM_NAME = 6;
    const CAR_FTL_CLIENT_NAME = 7;
    const CAR_FTL_TM_NAME = 8;
    const CAR_WH_TR_NAME = 9;
    const TR_NAME = 10;
    const WH_CROSS_NAME = 11;
    const WH_GETTING_NAME = 12;
    const WH_KTK_DOWNLOADING_NAME = 13;

    const CAR_PROVIDER_CLIENT_NAME = 14;

    const NEW_STATUS = 1;
    const IN_PROCESS_STATUS = 2;
    const DONE_STATUS = 3;

    const SINGLE = 1;
    const NOT_SINGLE = 0;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'order';

    /**
     * The "type" of the auto-incrementing ID.
     *
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['is_single', 'notes', 'lead_id', 'type', 'name', 'index', 'status', 'responsible_user_id', 'active_responsible_user_id', 'responsible_chief_id', 'responsible_branch_chief_id', 'created_at', 'updated_at', 'wh_gt_order_id'];

    public function isSingle():bool
    {
        return $this->is_single === self::SINGLE;
    }

    public function getGoodsAttribute()
    {
        if($this->goods()->exists()){
            return $this->goods()->get();
        }

        return [];
    }

    public function gettingAct()
    {
        return $this->hasOne(GettingAct::class);
    }

    public function getGoodsClients()
    {
        if(!$this->goods()->exists()){
            return [];
        }

        return Client::whereIn('id', $this->goods()->pluck('client_id')->toArray())->pluck('name', 'id');
    }

    public function goods()
    {
        return $this->belongsToMany(Goods::class, GoodsOrders::class, 'order_id');
    }

    public function goodsOrders()
    {
        return $this->hasMany(GoodsOrders::class);
    }

    public function scopeSingleValue($query, $isSingle)
    {
        return $query->where('is_single', $isSingle);
    }

    public function scopeSingle()
    {
        return $this->where('is_single', self::SINGLE);
    }

    public function scopeNotSingle()
    {
        return $this->where('is_single', self::NOT_SINGLE);
    }

    public function whGtOrder()
    {
        return $this->hasOne(Order::class, 'id', 'wh_gt_order_id');
    }

    public function prFtlOrder()
    {
       return $this->query()->where('wh_gt_order_id', '=', $this->id)->first();
    }

    public function updateWhGtOrder()
    {
        if($this->name == self::CAR_PROVIDER_FTL_NAME && $this->whGtOrder()->exists()){

            $goodsOrdersService = app(GoodsOrdersService::class);
            $ftlDateTime = $this->ftlBlock->dateTimeBlock;
            $this->whGtOrder->dateTimeBlock->update([
                'date' => $ftlDateTime['date'],
                'time' => $ftlDateTime['time'],
                'interval' => $ftlDateTime['interval'],
                'time_from' => $ftlDateTime['time_from'],
                'time_to' => $ftlDateTime['time_to'],
            ]);

            $goodsOrdersService->deleteByOrderId($this->whGtOrder->id);
            $goodsOrdersService->syncWithOrder($this);
        }
    }

    public function getOrderBlocks()
    {
        $service = new OrderBlocksService($this);
        return $service->getOrderBlocks();
    }

    public function getLeadOrderBlocks()
    {
        $service = new OrderBlocksService($this);
        return $service->getLeadOrderBlocks();
    }

    public static function orderTypes():array
    {
        return [
            self::CAR_TYPE => 'Авто',
            self::TR_TYPE => 'ЖД',
            self::WH_TYPE => 'Склад'
        ];
    }

    public static function getStatusLabels():array
    {
        return [
            self::NEW_STATUS => 'Новая',
            self::IN_PROCESS_STATUS => 'В работе',
            self::DONE_STATUS => 'Согласована',
        ];
    }

    public static function orderIndex():array
    {
        return [
            self::CAR_HEAVY_RENT_NAME => 'Авто:Зак.Тяж',
            self::CAR_PROVIDER_FTL_NAME => 'Авто:П-ФТЛ',
            self::CAR_TM_FTL_TR_NAME => 'Авто:ТМ-ФТЛ-ЖД',
            self::CAR_TM_PROVIDER_TR_NAME => 'Авто:ТМ-П-ЖД',
            self::CAR_TR_FTL_TM_NAME => 'Авто:ЖД-ФТЛ-ТМ',
            self::CAR_TR_CLIENT_TM_NAME => 'Авто:ЖД-КЛ-ТМ',
            self::CAR_FTL_CLIENT_NAME => 'Авто:ФТЛ-КЛ',
            self::CAR_FTL_TM_NAME => 'Авто:ФТЛ-ТМ',
            self::CAR_WH_TR_NAME => 'Авто:СКЛ-ЖД',
            self::TR_NAME => 'ЖД',
            self::WH_CROSS_NAME => 'СКЛ:К-Д',
            self::WH_GETTING_NAME => 'СКЛ:П',
            self::WH_KTK_DOWNLOADING_NAME => 'СКЛ:З-КТК',
            self::CAR_PROVIDER_CLIENT_NAME => 'Авто:П-КЛ'
        ];
    }

    public static function orderNames():array
    {
        return [
            self::CAR_HEAVY_RENT_NAME => 'Авто Заявка: Заказ тяж. техники',
            self::CAR_PROVIDER_FTL_NAME => 'Авто Заявка: Поставщик - ФТЛ',
            self::CAR_TM_FTL_TR_NAME => 'Авто Заявка: Терминал - ФТЛ - ЖД',
            self::CAR_TM_PROVIDER_TR_NAME => 'Авто Заявка: Терминал - Поставщик - ЖД',
            self::CAR_TR_FTL_TM_NAME => 'Авто Заявка: ЖД - ФТЛ - Терминал',
            self::CAR_TR_CLIENT_TM_NAME => 'Авто Заявка: ЖД - Клиент - Терминал',
            self::CAR_FTL_CLIENT_NAME => 'Авто Заявка: ФТЛ - Клиенту',
            self::CAR_FTL_TM_NAME => 'Авто Заявка: ФТЛ - Терминал',
            self::CAR_WH_TR_NAME => 'Авто Заявка: Склад - ЖД',
            self::TR_NAME => 'Заявка в ЖД Отдел',
            self::WH_CROSS_NAME => 'Склад Заявка: Кросс-Докинг',
            self::WH_GETTING_NAME => 'Склад Заявка: Приём',
            self::WH_KTK_DOWNLOADING_NAME => 'Склад Заявка: Загрузка КТК',
            self::CAR_PROVIDER_CLIENT_NAME => 'Авто Заявка: Поставщик - Клиент'
        ];
    }

    public function firstCarPoint()
    {
        switch ($this->name){
            case self::CAR_PROVIDER_FTL_NAME:
            case self::CAR_WH_TR_NAME:
            case self::CAR_PROVIDER_CLIENT_NAME:
                $point = $this->providerBlock();
                break;
            case self::CAR_TM_FTL_TR_NAME:
            case self::CAR_TM_PROVIDER_TR_NAME:
                $point = $this->terminalBlock();
                break;
            case self::CAR_TR_FTL_TM_NAME:
            case self::CAR_TR_CLIENT_TM_NAME:
                $point = $this->trainBlock();
                break;
            case self::CAR_FTL_CLIENT_NAME:
            case self::CAR_FTL_TM_NAME:
                $point = $this->ftlBlock();
                break;
        }

        return $point;
    }

    public function lastCarPoint()
    {
        switch ($this->name){
            case self::CAR_PROVIDER_FTL_NAME:
                $point = $this->ftlBlock();
                break;
            case self::CAR_TM_FTL_TR_NAME:
            case self::CAR_TM_PROVIDER_TR_NAME:
            case self::CAR_WH_TR_NAME:
                $point = $this->trainBlock();
                break;
            case self::CAR_TR_FTL_TM_NAME:
            case self::CAR_FTL_TM_NAME:
            case self::CAR_TR_CLIENT_TM_NAME:
                $point = $this->terminalBlock();
                break;
            case self::CAR_FTL_CLIENT_NAME:
            case self::CAR_PROVIDER_CLIENT_NAME:
                $point = $this->clientBlock();
                break;
        }

        return $point;
    }

    public function userCanChat(UserManager $userManager):bool
    {
        return in_array($userManager->getId(), [$this->lead->responsible_user_id, $this->responsible_user_id, $this->responsible_chief_id])
            || $userManager->hasRole('admin');
    }

    public function getDriverReportByName($name)
    {
        return $this->lead->orders()->where('name', '=', $name)->first()->driverReport()->first();
    }

    public function getDriverReportForWhGettingOrder()
    {
        $report = $this->lead->orders()->where('name', '=', self::CAR_PROVIDER_FTL_NAME);
        if(!$report->exists()){
            $report = $this->lead->orders()->where('name', '=', self::CAR_TM_FTL_TR_NAME);
        }

        if($report->exists() && $report->first()->driverReport()->exists()){
            return $report->first()->driverReport()->first();
        }

        return new DriverReport();
    }

    public function isOldest()
    {
        $isOldest = false;
        $lead = $this->lead;
        $similarTypeOrders = $lead->orders()->where('name', $this->name)->get();
        if($similarTypeOrders->count() == 0){
            $isOldest = true;
        }else{
            foreach ($similarTypeOrders as $similarTypeOrder) {
                if($this->id < $similarTypeOrder->id){
                    $isOldest = true;
                    break;
                }
            }
        }

        return $isOldest;
    }

    public function whGettingReport()
    {
        return $this->hasOne(WhGettingReport::class);
    }

    public function powerOfAttorneyReport()
    {
        return $this->hasOne(PowerOfAttorneyReport::class);
    }

    public function waybillReport()
    {
        return $this->hasOne(WaybillReport::class);
    }

    public function routeTrackReport()
    {
        return $this->hasOne(RouteTrackReport::class);
    }

    public function heavyRentReport()
    {
        return $this->hasOne(HeavyRentReport::class);
    }

    /**
     * @return HasMany
     */
    public function orderChatMessages()
    {
        return $this->hasMany(OrderChat::class);
    }

    public function carPointReports()
    {
        return $this->hasMany(CarPointReport::class);
    }

    public function getCarPoint($step)
    {
        return $this->carPointReports()
            ->where('step', $step)->first();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function lead()
    {
        return $this->belongsTo(Leads::class);
    }

    public function cargoReport()
    {
        return $this->hasOne(CargoReport::class);
    }

    public function forwardingReport()
    {
        return $this->hasOne(ForwardingReport::class);
    }

    public function trainReports()
    {
        return $this->hasMany(TrainReport::class);
    }

    public function trainReportByDate($date)
    {
        return $this->trainReports()
            ->where('date', '=', $date);
    }

    public function carReport()
    {
        return $this->hasMany(CarReport::class);
    }

    public function getCarReportByDate($date)
    {
        $firstPoint = $this->firstCarPoint();
        $lastPoint = $this->lastCarPoint();

        $firstDate = $firstPoint->first()->dateTimeBlock;
        $secondDate = $lastPoint->first()->dateTimeBlock;

        if(empty($firstDate) || empty($secondDate)){
            return false;
        }

        if($report = CarReport::where('date', $date)
            ->whereBetween('date', [$firstDate->date, $secondDate->date])
            ->where('order_id', $this->id)
            ->first()){
            return $report;
        }

        return false;
    }

    public function getTrainReportByDate($date)
    {
        $trainOrderBegin = $this->trainOrderFromBlocks()->first();
        $trainOrderEnd = $this->trainOrderToBlocks()->first();

        $trainReport = $this->trainReportByDate($date)->first();

        if(empty($trainReport)){
            return false;
        }

        if(empty($trainOrderBegin) || empty($trainOrderEnd)){
            return false;
        }

        if(strtotime($trainReport->date) >= strtotime($trainOrderBegin->date) && strtotime($trainReport->date) <= strtotime($trainOrderEnd->date)){
            return $trainReport;
        }

        return false;

    }

    /**
     * @return HasOne
     */
    public function clientBlock()
    {
        return $this->hasOne(ClientBlock::class);
    }

    /**
     * @return HasOne
     */
    public function ftlBlock()
    {
        return $this->hasOne(FtlBlock::class);
    }

    /**
     * @return HasOne
     */
    public function providerBlock()
    {
        return $this->hasOne(ProviderBlock::class);
    }

    /**
     * @return HasOne
     */
    public function terminalBlock()
    {
        return $this->hasOne(TerminalBlock::class);
    }

    /**
     * @return HasOne
     */
    public function trainBlock()
    {
        return $this->hasOne(TrainBlock::class);
    }

    /**
     * @return HasOne
     */
    public function driverBlock()
    {
        return $this->hasOne(DriverBlock::class);
    }

    /**
     * @return HasOne
     */
    public function specCondsBlock()
    {
        return $this->hasOne(SpecCondsBlock::class);
    }

    /**
     * @return HasOne
     */
    public function heavyRentBlock()
    {
        return $this->hasOne(HeavyRentBlock::class);
    }

    /**
     * @return HasOne
     */
    public function dateTimeBlock()
    {
        return $this->hasOne(DateTimeBlock::class, 'block_id', 'id')
            ->where('block_type', Block::ORDER_TYPE);
    }

    /**
     * @return HasMany
     */
    public function trainOrderBlocks()
    {
        return $this->hasMany(TrainOrderBlock::class);
    }

    public function trainOrderFromBlocks()
    {
        return $this->trainOrderBlocks()->where('type', TrainOrderBlock::BEGIN_TYPE);
    }

    public function trainOrderToBlocks()
    {
        return $this->trainOrderBlocks()->where('type', TrainOrderBlock::END_TYPE);
    }

    public function driverReport()
    {
        return $this->hasOne(DriverReport::class);
    }

    public function isEmpty():bool
    {
        $attributes = $this->getAttributes();
        $hiddenAttributes = $this->getHidden();
        array_map(function($el)use(&$attributes){
            unset($attributes[$el]);
        }, $hiddenAttributes);
        foreach ($attributes as $key => &$attribute) {
            if(blank($attribute)){
                unset($attributes[$key]);
            }
        }
        return count($attributes) === 0;
    }

    public function goodsFromCurrentOrderName($goodsId)
    {
        return GoodsOrders::where('goods_id', $goodsId)
            ->where('order_name', $this->name)
            ->where('lead_id', $this->lead_id)
            ->exists();
    }

    public function goodsFromCurrentOrder($goodsId)
    {
        return GoodsOrders::where('goods_id', $goodsId)
            ->where('order_id', $this->id)
            ->exists();
    }

    public function goodsFromOtherOrderName($goodsId)
    {
        return GoodsOrders::where('goods_id', $goodsId)
            ->where('order_name', '!=', $this->name)
            ->where('lead_id', $this->lead_id)
            ->exists();
    }

    public function goodsFromOtherOrder($goodsId)
    {
        return GoodsOrders::where('goods_id', $goodsId)
            ->where('lead_id', $this->lead_id)
            ->where('order_id', '!=', $this->id)
            ->exists();
    }

    public function getAllOrderGoods()
    {
        return $this->lead->goods;
    }

    public function getCurrentOrderGoods()
    {
        $results = new Collection();

        if(GoodsOrders::where('order_id', $this->id)->exists()){
            GoodsOrders::where('order_id', $this->id)->get()->each(function($el)use($results){
                $results->push($el->goods);
            });
        }

        return $results;
    }

    public function canReport($userId)
    {
        return $userId == $this->active_responsible_user_id && $userId == $this->responsible_user_id && $this->status == EntityStatus::IN_PROCESS_STATUS;
    }

}

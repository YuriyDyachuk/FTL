<?php


namespace App\Models\Services;


use App\Models\Entities\Order;
use App\Models\Entities\OrderBlocksTemplate;

class OrderBlocksService
{
    private Order $order;
    private OrderBlocksTemplate $orderBlocksTemplate;

    public function __construct(Order $order)
    {
        $this->order = $order;
        $this->orderBlocksTemplate = new OrderBlocksTemplate();
    }

    public function getLeadOrderBlocks():OrderBlocksTemplate
    {
        switch($this->order->name){
//            case Order::CAR_HEAVY_RENT_NAME:
//                $this->getCarHeavyRentBlocks();
//                break;
            case Order::CAR_PROVIDER_FTL_NAME:
                $this->getCarProviderFtlBlocks();
                break;
            case Order::CAR_TM_FTL_TR_NAME:
                $this->getCarTmFtlTrBlocks();
                break;
            case Order::CAR_TM_PROVIDER_TR_NAME:
                $this->getCarTmProviderTrBlocks();
                break;
            case Order::CAR_TR_FTL_TM_NAME:
                $this->getCarTrFtlTmBlocks();
                break;
            case Order::CAR_TR_CLIENT_TM_NAME:
                $this->getCarTrClientTmBlocks();
                break;
            case Order::CAR_FTL_CLIENT_NAME:
                $this->getCarFtlClientBlocks();
                break;
            case Order::CAR_FTL_TM_NAME:
                $this->getCarWhTmBlocks();
                break;
            case Order::CAR_WH_TR_NAME:
                $this->getCarWhTrBlocks();
                break;
//            case Order::TR_NAME:
//                $this->getTrBlocks();
//                break;
            case Order::WH_CROSS_NAME:
                $this->getWhCrossBlocks();
                break;
            case Order::WH_GETTING_NAME:
                $this->getWhGettingBlocks();
                break;
            case Order::WH_KTK_DOWNLOADING_NAME:
                $this->getWhKtkDownloadingBlocks();
                break;
        }
        return $this->orderBlocksTemplate;
    }

    public function getOrderBlocks():OrderBlocksTemplate
    {
        switch($this->order->name){
            case Order::CAR_HEAVY_RENT_NAME:
                $this->getCarHeavyRentBlocks();
                break;
            case Order::CAR_PROVIDER_FTL_NAME:
                $this->getCarProviderFtlBlocks();
                break;
            case Order::CAR_PROVIDER_CLIENT_NAME:
                $this->getCarProviderClientBlocks();
                break;
            case Order::CAR_TM_FTL_TR_NAME:
                $this->getCarTmFtlTrBlocks();
                break;
            case Order::CAR_TM_PROVIDER_TR_NAME:
                $this->getCarTmProviderTrBlocks();
                break;
            case Order::CAR_TR_FTL_TM_NAME:
                $this->getCarTrFtlTmBlocks();
                break;
            case Order::CAR_TR_CLIENT_TM_NAME:
                $this->getCarTrClientTmBlocks();
                break;
            case Order::CAR_FTL_CLIENT_NAME:
                $this->getCarFtlClientBlocks();
                break;
            case Order::CAR_FTL_TM_NAME:
                $this->getCarWhTmBlocks();
                break;
            case Order::CAR_WH_TR_NAME:
                $this->getCarWhTrBlocks();
                break;
            case Order::TR_NAME:
                $this->getTrBlocks();
                break;
            case Order::WH_CROSS_NAME:
                $this->getWhCrossBlocks();
                break;
            case Order::WH_GETTING_NAME:
                $this->getWhGettingBlocks();
                break;
            case Order::WH_KTK_DOWNLOADING_NAME:
                $this->getWhKtkDownloadingBlocks();
                break;
        }
        return $this->orderBlocksTemplate;
    }

    private function getWhKtkDownloadingBlocks()
    {
        $this->setDriverBlocks();
        $this->setDateTimeBlocks();
    }

    private function getWhGettingBlocks()
    {
        $this->setDriverBlocks();
        $this->setDateTimeBlocks();
    }

    private function getWhCrossBlocks()
    {
        $this->setDriverBlocks();
        $this->setDateTimeBlocks();
    }

    private function getTrBlocks()
    {
        $this->setTrFromBlock();
        $this->setTrToBlock();
    }

    private function getCarWhTrBlocks()
    {
        $this->setProviderBlocks(0);
        $this->setTrainBlocks(1);
        $this->setDriverBlocks();
        $this->setSpecCondsBlocksOrders();
    }

    private function getCarWhTmBlocks()
    {
        $this->setFtlBlocks(0);
        $this->setTerminalBlocks(1);
        $this->setDriverBlocks();
        $this->setSpecCondsBlocksOrders();
    }

    private function getCarFtlClientBlocks()
    {
        $this->setFtlBlocks(0);
        $this->setClientBlocks(1);
        $this->setDriverBlocks();
        $this->setSpecCondsBlocksOrders();
    }

    private function getCarTrClientTmBlocks()
    {
        $this->setTrainBlocks(0);
        $this->setClientBlocks(1);
        $this->setTerminalBlocks(2);
        $this->setDriverBlocks();
        $this->setSpecCondsBlocksOrders();
    }

    private function getCarTrFtlTmBlocks()
    {
        $this->setTrainBlocks(0);
        $this->setFtlBlocks(1);
        $this->setTerminalBlocks(2);
        $this->setDriverBlocks();
        $this->setSpecCondsBlocksOrders();
    }

    private function getCarTmProviderTrBlocks()
    {
        $this->setTerminalBlocks(0);
        $this->setProviderBlocks(1);
        $this->setTrainBlocks(2);
        $this->setDriverBlocks();
        $this->setSpecCondsBlocksOrders();
    }

    private function getCarTmFtlTrBlocks()
    {
        $this->setTerminalBlocks(0);
        $this->setFtlBlocks(1);
        $this->setTrainBlocks(2);
        $this->setDriverBlocks();
        $this->setSpecCondsBlocksOrders();
    }

    private function getCarProviderFtlBlocks()
    {
        $this->setProviderBlocks(0);
        $this->setFtlBlocks(1);
        $this->setDriverBlocks();
        $this->setSpecCondsBlocksOrders();
    }

    private function getCarProviderClientBlocks()
    {
        $this->setProviderBlocks(0);
        $this->setClientBlocks(1);
        $this->setDriverBlocks();
        $this->setSpecCondsBlocksOrders();
    }

    private function getCarHeavyRentBlocks()
    {
       $this->setCarHeavyRentBlocks(0);
    }

    private function setTerminalBlocks(int $position)
    {
        if($this->order->terminalBlock()->exists()){
            $this->orderBlocksTemplate->addPoint($position, $this->order->terminalBlock()->first());
        }
    }

    private function setTrainBlocks(int $position)
    {
        if($this->order->trainBlock()->exists()){
            $this->orderBlocksTemplate->addPoint($position, $this->order->trainBlock()->first());
        }
    }

    public function setCarHeavyRentBlocks(int $position)
    {
        if($this->order->heavyRentBlock()->exists()){
            $this->orderBlocksTemplate->addPoint($position, $this->order->heavyRentBlock()->first());
        }
    }

    private function setFtlBlocks(int $position)
    {
        if($this->order->ftlBlock()->exists()){
            $this->orderBlocksTemplate->addPoint($position, $this->order->ftlBlock()->first());
        }
    }

    private function setProviderBlocks(int $position)
    {
        if($this->order->providerBlock()->exists()){
            $this->orderBlocksTemplate->addPoint($position, $this->order->providerBlock()->first());
        }
    }

    private function setSpecCondsBlocksOrders()
    {
        if($this->order->specCondsBlock()->exists()){
            $this->orderBlocksTemplate->addSpecialCondition($this->order->specCondsBlock()->first());
        }
    }

    private function setClientBlocks(int $position)
    {
        if($this->order->clientBlock()->exists()){
            $this->orderBlocksTemplate->addPoint($position, $this->order->clientBlock()->first());
        }
    }

    private function setDriverBlocks()
    {
        if($this->order->driverBlock()->exists()){
            $this->orderBlocksTemplate->addDriver($this->order->driverBlock()->first());
        }
    }

    private function setDateTimeBlocks()
    {
        if($this->order->dateTimeBlock()->exists()){
            $this->orderBlocksTemplate->setDateTime($this->order->dateTimeBlock);
        }
    }

    private function setTrFromBlock()
    {
        if($this->order->trainOrderFromBlocks()->exists()){
            $this->orderBlocksTemplate->addPoint(0, $this->order->trainOrderFromBlocks()->first());
        }
    }

    private function setTrToBlock()
    {
        if($this->order->trainOrderToBlocks()->exists()){
            $this->orderBlocksTemplate->addPoint(1, $this->order->trainOrderToBlocks()->first());
        }
    }

}

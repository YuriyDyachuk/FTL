<?php


namespace App\Models\Observers;


use App\Models\Entities\Order;

class OrderObserver
{
    public function deleting(Order $order)
    {
        $order->dateTimeBlock()->delete();
        optional($order->cargoReport())->delete();
        optional($order->driverReport())->delete();
        optional($order->trainReports())->delete();
        optional($order->forwardingReport())->delete();
        optional($order->carPointReports())->delete();
        optional($order->waybillReport())->delete();
        optional($order->routeTrackReport())->delete();
        optional($order->heavyRentReport())->delete();
        optional($order->powerOfAttorneyReport())->delete();
        optional($order->whGettingReport())->delete();
        optional($order->carReport())->delete();

        //$order->driverBlocks()->delete();
        //$order->specCondsBlocks()->delete();

        optional($order->orderChatMessages())->delete();

        optional(optional($order->clientBlock)->dateTimeBlock())->delete();
        optional(optional($order->clientBlock)->agentBlock())->delete();

        optional(optional($order->ftlBlock)->dateTimeBlock())->delete();
        optional(optional($order->ftlBlock)->agentBlock())->delete();

        optional(optional($order->providerBlock)->agentBlock())->delete();
        optional(optional($order->providerBlock)->dateTimeBlock())->delete();

        optional(optional($order->terminalBlock)->dateTimeBlock())->delete();
        optional(optional($order->terminalBlock)->agentBlock())->delete();

        optional(optional($order->trainBlock)->dateTimeBlock())->delete();
        optional(optional($order->trainBlock)->agentBlock())->delete();
    }
}

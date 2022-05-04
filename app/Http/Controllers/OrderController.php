<?php

namespace App\Http\Controllers;

use App\Models\Entities\Block;
use App\Models\Entities\Block\DateTimeBlock;
use App\Models\Entities\Block\FtlBlock;
use App\Models\Entities\ClientRequestFrom;
use App\Models\Entities\EntityStatus;
use App\Models\Entities\GettingAct;
use App\Models\Entities\Goods;
use App\Models\Entities\Leads;
use App\Models\Entities\Order;
use App\Models\Entities\OrderChat;
use App\Models\Repositories\OrderRepository;
use App\Models\Services\OrderBlocksService;
use App\Models\Services\OrderService;
use App\Models\Validation\GoodsValidation;
use App\User;
use Auth;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use App\Models\Validation\OrderValidation;
use App\Models\Services\Block\BlockService;
use Nahid\Talk\Facades\Talk;
use View;


class OrderController extends Controller
{
    private $orderService;
    private $orderValidation;
    private $blockService;
    private $goodsValidation;

    public function __construct(OrderService $orderService,
                                OrderValidation $orderValidation,
                                BlockService $blockService,
                                GoodsValidation $goodsValidation)
    {
        $this->orderService = $orderService;
        $this->orderValidation = $orderValidation;
        $this->blockService = $blockService;
        $this->goodsValidation = $goodsValidation;
    }

    public function singleIndex(Request $request)
    {
        $orders = $this->orderService->getWhForCurrentUser(\Auth::getUser(), Order::SINGLE);
        if (!empty($request->input('q'))) {
            $orders = $this->filterOrders($orders, $request->input('q'));
        }

        return view('order.index', ['orders' => $orders->sortable(['created_at' => 'desc'])->paginate(env('ITEMS_PER_PAGE'))]);
    }

    public function carIndex(Request $request)
    {
        $orders = $this->orderService->getCarForCurrentUser(\Auth::getUser(), Order::NOT_SINGLE);
        if (!empty($request->input('q'))) {
            $orders = $this->filterOrders($orders, $request->input('q'));
        }

        return view('order.index', ['orders' => $orders->sortable(['created_at' => 'desc'])->paginate(env('ITEMS_PER_PAGE'))]);
    }

    public function whIndex(Request $request)
    {
        $orders = $this->orderService->getWhForCurrentUser(\Auth::getUser(), Order::NOT_SINGLE);
        if (!empty($request->input('q'))) {
            $orders = $this->filterOrders($orders, $request->input('q'));
        }
        return view('order.index', ['orders' => $orders->sortable(['created_at' => 'desc'])->paginate(env('ITEMS_PER_PAGE'))]);
    }

    public function trIndex(Request $request)
    {
        $orders = $this->orderService->getTrForCurrentUser(\Auth::getUser(), Order::NOT_SINGLE);

        if (!empty($request->input('q'))) {
            $orders = $this->filterOrders($orders, $request->input('q'));
        }
        return view('order.index', ['orders' => $orders->sortable(['created_at' => 'desc'])->paginate(env('ITEMS_PER_PAGE'))]);
    }

    public function filterOrders(Builder $orders, $param)
    {
        return $orders
            ->client($param)
            ->activeResponsibleName($param, true)
            ->orWhere('lead_id', 'LIKE', '%' . $param . '%');

    }

    public function edit(Order $order)
    {
        $orderBlocksService = new OrderBlocksService($order);
        $orderBlocks = $orderBlocksService->getOrderBlocks();
        $canEdit = $this->orderService->userCanEdit(Auth::getUser(), $order);
        $messages = OrderChat::where('order_id', $order->id)->get();

        return view('order.edit', ['order' => $order, 'orderBlocks' => $orderBlocks, 'canEdit' => $canEdit, 'messages' => $messages]);
    }

    public function validateAndSave(Request $request)
    {
        $order = $this->orderService->getById($request->input('id'));
        $requestData = $request->only(['responsible_user_id', 'responsible_chief_id', 'responsible_branch_chief_id', 'notes']);
        $validateMessageBag = $this->orderValidation->validate($request->all(), $order->isSingle());

        if ($validateMessageBag->count() === 0) {
            $order->update($requestData);
            $order->updateWhGtOrder();
            return 1;
        } else {
            $messages = $this->orderValidation->getUniqueMessages($validateMessageBag->getMessages());
            return json_encode($messages);
        }
    }

    public function validateGoods(Request $request)
    {
        $validateMessageBag = $this->goodsValidation->validate($request->all());

        if ($validateMessageBag->count() === 0) {
            return 1;
        } else {
            $messages = $this->orderValidation->getUniqueMessages($validateMessageBag->getMessages());

            return json_encode($messages);
        }
    }

    public function updateBlock(Request $request)
    {
        $this->blockService->updateBlock($request->input('blocktype'), $request->except(['_method']));

        return 1;
    }

    public function createSingle()
    {
        $order = $this->orderService->createSingleOrder(Leads::CAR_TYPE, Order::WH_TYPE, Order::WH_GETTING_NAME, EntityStatus::NEW_STATUS);

        return redirect()->route('order.edit', $order);
    }

    public function getExportForm(Order $order)
    {
        return view('order.single.export.form', ['goods' => $order->goods]);
    }

    public function bindSingleToLead(Order $order, Request $request)
    {
        $totalWeight = $order->goods()->pluck('weight')->sum() / 1000;
        $totalVolume = $order->goods()->pluck('volume')->sum() / 1000;


        $this->orderService->bindGoodsToLead($order, $order->lead, $request->input('export'));
        $order->update(['is_single' => Order::NOT_SINGLE]);
        $order->lead->update(['enable' => Leads::ENABLE, 'type' => $request->input('lead_type')]);
        $order->lead->clientRequest->update(['status' => EntityStatus::DONE_STATUS]);


        $order->lead->clientRequest->ftlwhFrom->update([
            'unl_cont_ktk_weight' => $totalWeight,
            'unl_cont_ktk_volume' => $totalVolume,
            'unl_on' => ClientRequestFrom::UNL_ON_CONTAINER,
            'unl_cont_ktk_type' => '20f'
        ]);

        return json_encode([
            'label' => $order->lead->getShortLabel(),
            'id' => $order->lead->id
        ]);
    }

    public function report(GettingAct $gettingAct, Request $request)
    {
        $gettingAct->update($request->except('product'));
        foreach ($request->input('product') as $product) {
            $model = Goods::find($product['id']);
            $model->update($product);
            $model->status = Goods::IN_THE_WAREHOUSE_STATUS;
            $model->save();
        }

        return redirect()->route('order.edit', $gettingAct->order);

    }

}

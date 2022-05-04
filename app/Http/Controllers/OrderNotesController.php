<?php

namespace App\Http\Controllers;

use App\Models\Entities\ClientRequests;
use App\Models\Entities\OrderNotes;
use App\Models\Repositories\OrderRepository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

use App\Models\Services\OrderNotesService;


class OrderNotesController extends Controller
{
    private $orderNotesService;
    private $orderRepository;

    public function __construct(OrderNotesService $orderNotesService,
                                OrderRepository $orderRepository)
    {
        $this->orderNotesService = $orderNotesService;
        $this->orderRepository = $orderRepository;
    }

    public function saveNote(Request $request)
    {
        $this->orderNotesService->createUserNote($request);
        $this->orderRepository->update($request->toArray());
    }

    public function getNotes(Request $request)
    {
        $orderId = $request->input('order_id');
        $notes = $this->orderNotesService->getNotes($orderId);
        $returnHTML = view('widgets.order_notes_index')->with('notes', $notes)->render();
        return response()->json(['success' => true, 'html' => $returnHTML]);
    }
}

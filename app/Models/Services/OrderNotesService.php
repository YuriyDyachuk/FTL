<?php


namespace App\Models\Services;

use App\Models\Repositories\OrderNotesRepository;
use Illuminate\Http\Request;

class OrderNotesService
{
    private $orderNotesRepository;

    public function __construct(OrderNotesRepository $orderNotesRepository)
    {
        $this->orderNotesRepository = $orderNotesRepository;
    }

    public function createUserNote(Request $request)
    {
        $this->orderNotesRepository->createUserNote($request);
    }

    public function getNotes($orderId):array
    {
        $userNotes = $this->orderNotesRepository->getUserNotes($orderId);
        $systemNotes = $this->orderNotesRepository->getSystemNotes($orderId);
        return ['user' => $userNotes, 'system' => $systemNotes];
    }
}

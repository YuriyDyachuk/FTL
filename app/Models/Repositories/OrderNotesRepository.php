<?php


namespace App\Models\Repositories;


use App\Models\Entities\OrderNotes;
use Illuminate\Http\Request;

class OrderNotesRepository
{
    public function createUserNote(Request $request)
    {
        $model = new OrderNotes();
        $model->text = json_encode([
            'from' => \Auth::getUser()->name,
            'text' => $request->input('text')
        ]);
        $model->order_id = $request->input('order_id');
        $model->note_type = OrderNotes::USER_NOTE_TYPE;
        $model->note_desc = $request->input('desc');
        $model->save();
    }

    public function getUserNotes($order_id)
    {
        return OrderNotes::where('order_id', '=', $order_id)->where('note_type', '=', OrderNotes::USER_NOTE_TYPE)->get();
    }

    public function getSystemNotes($order_id)
    {
        return OrderNotes::where('order_id', '=', $order_id)->where('note_type', '=', OrderNotes::SYSTEM_NOTE_TYPE)->get();
    }

}

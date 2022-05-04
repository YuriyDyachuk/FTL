<?php


namespace App\Http\Controllers;


use App\Models\Entities\OrderChat;
use App\Models\Events\OrderChatEvent;
use App\User;
use Auth;
use Illuminate\Http\Request;
use Nahid\Talk\Facades\Talk;
use Pusher\Pusher;
use View;

class MessageController extends Controller
{

    public function chatHistory($id)
    {
        $messages = OrderChat::where('order_id', $id)->get();

        if ($messages->count() > 0) {
            $messages = $messages->sortBy('id');
        }

        return $messages;
    }

    public function ajaxSendMessage(Request $request)
    {
        Talk::setAuthUserId(Auth::getUser()->id);
        if ($request->ajax()) {
            $rules = [
                'message' => 'required',
                'order_id' => 'required',
                'user_id' => 'required'
            ];

            $this->validate($request, $rules);

            $body = $request->input('message');
            $userId = $request->input('user_id');
            $orderId = $request->input('order_id');
            $pusher = new Pusher( env('PUSHER_APP_KEY'), env('PUSHER_APP_SECRET'), env('PUSHER_APP_ID'), array( 'cluster' => env('PUSHER_APP_CLUSTER'), 'useTLS' => true, 'curl_options' => array( CURLOPT_IPRESOLVE => CURL_IPRESOLVE_V4 ) ) );



            if ($message = OrderChat::create(['message' => $body, 'user_id' => $userId, 'order_id' => $orderId])) {
                $pusher->trigger( 'ftl_chat', 'ftl_chat', ['message' => $message->message, 'name' => $message->user->name, 'id' => $message->id, 'user_id' => $message->user_id] );

                $html = view('ajax.newMessageHtml', compact('message'))->render();
                return response()->json(['status'=>'success', 'html'=>$html], 200);
            }
        }
    }
}

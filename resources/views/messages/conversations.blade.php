@push('head')
    <script src='http://cdnjs.cloudflare.com/ajax/libs/handlebars.js/3.0.0/handlebars.min.js'></script>
    <script src='http://cdnjs.cloudflare.com/ajax/libs/list.js/1.1.1/list.min.js'></script>
    <script src="{{ asset('js/talk.js') }}"></script>
@endpush


<div class="chat_panel">
    <div class="chat-panel-header">
        <h5>Чат</h5>
    </div>
</div>
    <div class="chat-panel-body d-none">

            <div class="chat">
                <div class="chat-header clearfix">
                    <div class="chat-about">
                        <div class="chat-with">Чат</div>
                    </div>
{{--                    <i class="fa fa-star"></i>--}}
                </div> <!-- end chat-header -->
                <div class="chat-history">
                    <ul id="talkMessages">

                        @foreach($messages as $message)
                            @if($message->user_id == auth()->user()->id)
                                <li class="clearfix" id="message-{{$message->id}}">
                                    <div class="message-data align-right">
                                        <span class="message-data-time" >{{$message->created_at->diffForHumans()}}</span> &nbsp; &nbsp;
                                        <span class="message-data-name" >{{$message->user->name}}</span>
                                    </div>
                                    <div class="message other-message float-right">
                                        {{$message->message}}
                                    </div>
                                </li>
                            @else
                                <li id="message-{{$message->id}}">
                                    <div class="message-data">
                                        <span class="message-data-time">{{$message->created_at->format('d.m.Y H:i')}} назад</span>
                                        <span class="message-data-name" >{{$message->user->name}}</span>
                                    </div>
                                    <div class="message my-message">
                                        {{$message->message}}
                                    </div>
                                </li>
                            @endif
                        @endforeach


                    </ul>

                </div> <!-- end chat-history -->

                <div class="chat-message clearfix">
                    <form class="no_disable_form" action="" method="post" id="talkSendMessage">
                        <textarea name="message" id="message-data" placeholder ="Введите сообщение" rows="3"></textarea>
                        <input type="hidden" name="user_id" value="{{ $userManager->getUser()->id }}">
                        <input type="hidden" name="order_id" value="{{ $order->id }}">
                        <button type="submit">Отправить</button>
                    </form>

                </div> <!-- end chat-message -->

            </div> <!-- end chat -->

    </div>


<script src="https://js.pusher.com/5.1/pusher.min.js"></script>
<script>

    // Enable pusher logging - don't include this in production
    //Pusher.logToConsole = true;

    var pusher = new Pusher('1c777e6b4ae547bb0ea6', {
        cluster: 'eu',
        forceTLS: true
    });

    var channel = pusher.subscribe('ftl_chat');
    //console.dir({channel: channel});
    channel.bind('ftl_chat', function(data) {
        msgshow(data);
    });
</script>




{{--<script>--}}

{{--</script>--}}

<script>
    // var show = function(data) {
    //     alert(data.sender.name + " - '" + data.message + "'");
    // }
    var msgshow = function(data) {
        var userId = {!! json_encode((array)auth()->user()->id) !!};
        var html = '';
       if(userId[0] === data.user_id){
           html = '<li class="clearfix" id="message-' + data.id + '">' +
               '<div class="message-data align-right">' +
               '<span class="message-data-name">' + data.name + '</span>' +
               '<span class="message-data-time">1 секунду назад</span>' +
               '</div>' +
               '<div class="message other-message float-right">' +
               data.message +
               '</div>' +
               '</li>';
       }else{
           html = '<li id="message-' + data.id + '">' +
               '<div class="message-data">' +
               '<span class="message-data-name">' + data.name + '</span>' +
               '<span class="message-data-time">1 секунду назад</span>' +
               '</div>' +
               '<div class="message my-message">' +
               data.message +
               '</div>' +
               '</li>';
           $('.chat-panel-body').removeClass('d-none');
       }

        $('#talkMessages').append(html);

        var objDiv = $('.chat-history');
        objDiv.scrollTop(objDiv.prop("scrollHeight"));
    }
</script>

{{--{!! talk_live(['user'=>["id"=>auth()->user()->id, 'callback'=>['msgshow']]]) !!}--}}

<li class="clearfix" id="message-{{$message->id}}">
    <div class="message-data align-right">
        <span class="message-data-time" >{{$message->created_at->diffForHumans()}}</span> &nbsp; &nbsp;
        <span class="message-data-name" >{{$message->user->name}}</span>
    </div>
    <div class="message other-message float-right">
        {{$message->message}}
    </div>
</li>

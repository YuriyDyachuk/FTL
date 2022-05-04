$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    var __baseUrl = "{{url('/')}}";

    $('#talkSendMessage').on('submit', function(e) {
        e.preventDefault();
        var url, request, tag, data;
        tag = $(this);
        url = route('message.new');
        data = tag.serialize();

        request = $.ajax({
            method: "post",
            url: url,
            data: data
        });

        request.done(function (response) {
            if (response.status === 'success') {
                $('#talkMessages').append(response.html);
                tag[0].reset();

                var objDiv = $('.chat-history');
                objDiv.scrollTop(objDiv.prop("scrollHeight"));
            }
        });

    });
});

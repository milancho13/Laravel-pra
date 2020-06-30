console.log('helloaa')
//ログを有効にする
Pusher.logToConsole = true;

var pusher = new Pusher('66628294d9d12f926cdd', {
    cluster: 'mt1',
    encrypted: true
});

//購読するチャンネルを指定
var pusherChannel = pusher.subscribe('chat');

//イベントを受信したら、下記処理
pusherChannel.bind('chat_event', function (data) {

    let appendText;
    let login = $('input[name="login"]').val();

    if (data.send === login) {
        appendText = '<div class="send" style="text-align:right"><p>' + data.message + '</p></div> ';
    } else if (data.recieve === login) {
        appendText = '<div class="recieve" style="text-align:left"><p>' + data.message + '</p></div> ';
    } else {
        return false;
    }

    // メッセージを表示
    $("#room").append(appendText);

    if (data.recieve === login) {
        // ブラウザへプッシュ通知
        Push.create("新着メッセージ",
            {
                body: data.message,
                timeout: 8000,
                onClick: function () {
                    window.focus();
                    this.close();
                }
            })

    }
});


$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
    }
});


// メッセージ送信
$("#btn_send").click(function () {
    console.log('hello')

    $.ajax({
        type: 'POST',
        url: '/chat/send',
        dataType: 'json',
        data: {
            message: $('textarea[name="message"]').val(),
            send: $('input[name="send"]').val(),
            recieve: $('input[name="recieve"]').val(),
        }
    }).done(function (result) {
        $('textarea[name="message"]').val('');
    }).fail(function (result) {

    });
});

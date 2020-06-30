$(document).ready(function() {
    $.ajaxSetup({
      headers: {
        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
      }
    });
    $("#btn_send").click(function() {
      const url = "/chat/send";
      $.ajax({
        url: url,
        data : {
            message : $('textarea[name="message"]').val(),
            send : $('input[name="send"]').val(),
            recieve : $('input[name="recieve"]').val(),
        },
        method: "POST"
      });
      return false;
    });
    window.Echo.channel("chat_event").listen("PusherEvent", e => {
      $("#room").prepend(
        "<div><label>タイトル：</label>" + e.posts.title + "</div>"
      );
      $("#room").prepend(
        "<div><label>内容：</label>" + e.posts.description + "</div>"
      );
    });
});
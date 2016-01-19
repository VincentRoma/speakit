(function(){
    "use strict";
    var PUBNUB_demo = PUBNUB.init({
        publish_key: 'pub-c-43fee2d2-8fc4-4b00-b424-dd315210e2c2',
        subscribe_key: 'sub-c-aca4aeda-be98-11e5-8408-0619f8945a4f',
        secret_key: 'sec-c-YzZhYjVmMTgtYjJmZS00ZTVlLTkwMTMtNWVhZTgyYWEzOTY0'
    });

    var id_user = Math.floor((Math.random() * 100000) + 1000);

    PUBNUB_demo.subscribe({
        channel: 'speak_it',
        message: function(m){
            display_message(m);
        }
    });

    var display_message = function(m){
        if(m.user == id_user){
            $("#chat_room").append('<li class="mine alert">'+ m.text +'</li>');
        }else{
            $("#chat_room").append('<li class="his alert alert-info">'+ m.text +'</li>');
        }
    };

    var send_message = function(){
        var message = $("#chat_input").val();
        $("#chat_input").val('');
        PUBNUB_demo.publish({
            channel: 'speak_it',
            message: {"text": message, "user": id_user},
            callback : function(m){console.log(m)}
        });
    };
    $("#btn_send").click(send_message());

    $(document).keypress(function(e) {
        if(e.which == 13) {
            send_message();
        }
    });
})();

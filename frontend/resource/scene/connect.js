ws = new WebSocket("ws://x.game.me:8282");
// 服务端主动推送消息时会触发这里的onmessage
ws.onmessage = function(e){
    // json数据转换成js对象
    // console.log(e);
    var data = eval("("+e.data+")");
    var type = data.type || '';
    switch(type){
        // Events.php中返回的init类型的消息，将client_id发给后台进行uid绑定
        case 'init':
            // 利用jquery发起ajax请求，将client_id发给后端进行uid绑定
            $.ajax({
                url: '/base/bind',
                type: 'POST',
                data: {client_id: data.client_id}
            })
            .done(function(data) {
                console.log("success");
                data = $.parseJSON(data);
                //调用初始化盒子
                var player_id = data.data.player_Id;
                var player_name = data.data.player_name;
                // var x = data.data.x;
                // var y = data.data.y;
                init.createBox(player_id, player_name, 217, 489);
                $('.data_player').text(player_id);
            })
            .fail(function() {
                console.log("error");
            });
            break;
        case 'notify_join':
            console.log(data);
            //新用户加入  调用方法
            Player.notify(data);
            break;
        case 'logout':
            console.log('用户退出' + data);
            u_id = data.u_id;
            $('#'+u_id).remove();
        default :
            console.log(e.data);
    }
};

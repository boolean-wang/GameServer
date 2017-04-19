    $('.pack').click(function(event) {
        console.log('点击背包');
        $('.detail').toggle(400).css({
            display: 'block',
        });
        return false;
    });

    $('.beast').click(function(event) {
        console.log('进阶');
        console.log($(this));

        $(this).animate({
            width: '80px',
            height: '80px',
            marginLeft: '180px',
            marginTop: '10px'
        },200,function(){
            $('.detail').toggle(400).css({
                display: 'block'
            });
            //不能这么写啊
            $(this).css({
                width: '60px',
                height: '60px',
                marginLeft: '190px',
                marginTop: '20px'
            });
        });
        return false;
    });

    $('.task').click(function(event) {
        console.log('点击任务');


        return false;

    });

    $('.attack').click(function() {
        console.log('点击攻击');
        return false;//组织事件冒泡
    });

    // .main 的点击事件
    $('.main').click(function(e) {
        console.log(111);
        var xx = e.offsetX;
        var yy = e.offsetY;

        //获取userId 让其移动到点击的点
        var userId = $('.data_player').text();
        $('#'+userId).animate({marginLeft: xx, marginTop: yy}, 3000,function(){
            //移动到达之后 向服务器发送自己的坐标
            console.log('到达位置'+ xx + '---' + yy);
            $('.l-x').text('x:'+xx);
            $('.l-y').text('y:'+yy);
            //服务器拿到数据 向所有用户发送一个updateLocation的数据
            $.post('/player/move', {xx: xx, yy: yy}, function(data, textStatus, xhr) {
                /*optional stuff to do after success */
                console.log('服务器操作成功' + data);
            });
        });


        console.log(xx + '---' + yy);
        return false;
    });



//还不能放在  $(function(){})里面, 算是局部变量了吗
var Player = {
    notify: function(data){
        var player_id = data.data.player_Id;
        var player_name = data.data.player_name;
        var join = $('.join');
        console.log(player_id, player_name);
        // var x = data.data.x;
        // var y = data.data.y;
        init.createBox(player_id, player_name, 217, 389);

        join.text(player_name + '加入游戏');
        join.slideDown('800', function() {
            $(this).css('display', 'block');
            setTimeout(function () {
                join.fadeOut('800');
            }, 1500);
        });
    },
    //更新其它用户的位置 不包括自己
    move: function (data) {
        var player_id = data.data.player_id;
        var x = data.data.x;
        var y = data.data.y;
        $('#'+player_id).animate({marginLeft: x, marginTop: y}, 3000,function(){
            //移动到达之后 向服务器发送自己的坐标
            console.log( player_id+ '到达位置'+ x + '---' + y);
        });
    }

};

var init = {
    //创建一个新的box
    createBox: function (player_id, player_name, x, y) {
        $('.main').prepend('<div id='+ player_id +' name='+ player_name +'></div>');
        $('#'+player_id).css({
            width: '30px',
            height: '30px',
            border:  '1px solid red',
            marginLeft: x+'px',
            marginTop:  y+'px',
            position: 'absolute'
        });
        var user_desc = 'user_desc'+player_id;
        $('#'+player_id).prepend('<div class="'+user_desc+'"><p>id: '+ player_id +'</p><p>名字:'+ player_name +'</p></ul><div>');
        $('.user_desc'+player_id).css({
            width: '80px',
            height: '80px',
            backgroundColor: 'coral',
            margin: '-1px 29px',
            position: 'absolute',
            display: 'none',
            fontSize: '10px',
            color: 'white',
            opacity: '0.8'
        });

        var type = arguments[4] ? arguments[4] : false;
        if(type){
            $('#'+player_id).css({
                backgroundColor: 'yellow'
            })
        }

        $('#'+player_id).mouseenter(function(){
           $('.'+user_desc).css('display', 'block');
            return false;
        }).mouseleave(function(){
            $('.'+user_desc).css('display', 'none');
            return false
        });
    },
    fillAttr:function (player_id, player_name, x, y) {
        $('.player_head').append('<div><p>id:'+ player_id +'</p><p>'+ player_name +'</p><p><span class=l-x>x:'+ x +'</span><span class=l-y>y:'+ y +'</span></p></div>');
        $('.player_head div').css({
            color: 'yellow',
            opacity: '0.8',
            position: 'absolute',
            margin: '65px 0px 0px 6px'
        });
        $('.player_head div span').css({
            padding: '5px'
        });
    }
};

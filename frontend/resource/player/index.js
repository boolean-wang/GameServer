$(function(){
    /**
     * 创建游戏角色
     */
    $('.create').click(function(){
        $('#mymodal').modal('show');
    });

    $('#submit').click(function() {
        var name = $('#player_name').val();
        $.ajax({
            url: '/player/create',
            type: 'POST',
            data: {'name': name},
        })
        .done(function(data) {
            if($.parseJSON(data).code == 200){
                $('#mymodal').modal('hide');
                window.location.href='/player/index';
            }
        })
        .fail(function() {
            console.log('error');
        })
    });

    /**
     * 进入游戏地图
     */
    $('.thumbnail').each(function(index){
        if(index !== $('.thumbnail').length -1 ){
            $(this).click(function(){
                var id = $(this).find('div p:eq(0)').attr('uId');//php的做法是给这个div 一个a标签 构造好要跳转的url
                console.log(id);
                window.location = 'http://www.baidu.com?id='+id;
            })
        }
    })
});